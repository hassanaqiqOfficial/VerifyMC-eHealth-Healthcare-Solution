<?php


class Datatable {
    private $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }


    public function data_output123()
    {
        echo "testing";
        $patient_id = 45862;
        $this->ci->db->where("patient_id", $patient_id);
        $result = $this->ci->db->get('patient')->result_array();
        echo "<pre>";
        print_r($result);
    }



    /**
     * Create the data output array for the DataTables rows
     *
     * @param array $columns Column information array
     * @param array $data    Data from the SQL get
     * @param bool  $isJoin  Determine the the JOIN/complex query or simple one
     *
     * @return array Formatted data in a row based format
     */
	public  $sql;
    static function data_output ( $columns, $data, $isJoin = false )
    {
        $out = array();
		

        for ( $i=0, $ien=count($data) ; $i<$ien ; $i++ ) {
            $row = array();

            for ( $j=0, $jen=count($columns) ; $j<$jen ; $j++ ) {
                $column = $columns[$j];
				if(!isset($columns[$j]['show']) || $columns[$j]['show'] == 'yes'  ){
				
				$column_name = $columns[$j]['db'];
					if(isset($columns[$j]["as"]))
					{
						$column_name = $columns[$j]['as'];	
					}
					elseif($columns[$j]["field"])
					{
						$column_name = $columns[$j]['field'];	
					}
					
					
					if(isset($column['ext']))
					{
						$ext = $column['ext'];	
					}
					else
					{
						$ext = array();	
					}

                // Is there a formatter?
                if ( isset( $column['formatter'] ) ) {
                    $row[ $column['dt'] ] = ($isJoin) ? $column['formatter']( $data[$i][ $column_name ], $data[$i] , $ext) : 
														$column['formatter']( $data[$i][ $column_name ], $data[$i] , $ext);
                }
                else {
                    $row[ $column['dt'] ] = $data[$i][ $column_name ];
                }
				}
            }

            $out[] = $row;
        }

        return $out;
    }


    /**
     * Paging
     *
     * Construct the LIMIT clause for server-side processing SQL query
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $columns Column information array
     *  @return string SQL limit clause
     */
    public function limit ( $request, $columns )
    {
        $limit = '';

        if ( isset($request['start']) && $request['length'] != -1 ) {
            $limit = "LIMIT ".intval($request['start']).", ".intval($request['length']);
        }

        return $limit;
    }


    /**
     * Ordering
     *
     * Construct the ORDER BY clause for server-side processing SQL query
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $columns Column information array
     *  @param bool  $isJoin  Determine the the JOIN/complex query or simple one
     *
     *  @return string SQL order by clause
     */
    public function order ( $request, $columns, $isJoin = false )
    {

        $order = '';

        if ( isset($request['order']) && count($request['order']) ) {
            $orderBy = array();
            $dtColumns = self::pluck( $columns, 'dt' );
            for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {
                // Convert the column index into the column data property
                $columnIdx = intval($request['order'][$i]['column']);
                $requestColumn = $request['columns'][$columnIdx];

                $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                $column = $columns[ $columnIdx ];

                if ( $requestColumn['orderable'] == 'true' ) {
                    $dir = $request['order'][$i]['dir'] === 'asc' ?
                        'ASC' :
                        'DESC';
						
                    if(isset($column['as']))
                    {
                        $orderBy[] = ($isJoin) ? $column['as'].' '.$dir : ''.$column['as'].' '.$dir;
                    }
                    else
                    {
                        $orderBy[] = ($isJoin) ? $column['db'].' '.$dir : ''.$column['db'].' '.$dir;
                    }


                }
            }
            if(!empty($orderBy))
            {
                $order = 'ORDER BY '.implode(', ', $orderBy);
            }

        }
		elseif(isset($request['default_order']) && $request['default_order'] != '' )
		{
			$order = 'ORDER BY '.$request['default_order'];
		}

        return $order;
    }


    /**
     * Searching / Filtering
     *
     * Construct the WHERE clause for server-side processing SQL query.
     *
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here performance on large
     * databases would be very poor
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $columns Column information array
     *  @param  array $bindings Array of values for PDO bindings, used in the sql_exec() function
     *  @param  bool  $isJoin  Determine the the JOIN/complex query or simple one
     *
     *  @return string SQL where clause
     */
    public function filter ( $request, $columns, &$bindings, $isJoin = false )
    {
        $globalSearch = array();
        $columnSearch = array();
        $dtColumns = self::pluck( $columns, 'dt' );
       
        if ( isset($request['search']) && $request['search']['value'] != '' ) {
            $str = $request['search']['value'];
            
            for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
                $requestColumn = $request['columns'][$i];
                $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                $column = $columns[ $columnIdx ];
               
                if ( $requestColumn['searchable'] == 'true' ) {
                    //$binding = self::bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
                    
					$binding =  $str;
					 
                    $globalSearch[] = ($isJoin) ? $column['db']." LIKE '%".$binding."%'" : "".$column['db']." LIKE '%".$binding."%'";
					if($column['db'] == "l_name")
					{
					  $globalSearch[] = "mmu_id LIKE '%".$binding."%'";
					  $globalSearch[] = "security_no LIKE '%".$binding."%'";
					  $globalSearch[] = "name LIKE '%".$binding."%'";	
					  $globalSearch[] = "CONCAT(l_name , ' ' ,name) LIKE '%".$binding."%'";
					  $globalSearch[] = "CONCAT(name , ' ' ,l_name) LIKE '%".$binding."%'";
					}
					
					if($column['db'] == 'phone')
					{
					  $globalSearch[] = "REPLACE(REPLACE(phone, '-', ''), '-', '') LIKE '%".$binding."%'";	
					}
                }
            }
			
        }
     
	    // Individual column filtering
        for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
            $requestColumn = $request['columns'][$i];
            $columnIdx = array_search( $requestColumn['data'], $dtColumns );
            $column = $columns[ $columnIdx ];

            $str = $requestColumn['search']['value']; 

            if ( $requestColumn['searchable'] == 'true' &&
                $str != '' ) {
                //$binding = self::bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
                $binding =  $str;
				
                $columnSearch[] = ($isJoin) ? $column['db']." LIKE '%".$binding."%'" : "".$column['db']." LIKE '%".$binding."%'";
				
            }
        }

        // Combine the filters into a single string
        $where = '';

        if ( count( $globalSearch ) ) {
            $where = '('.implode(' OR ', $globalSearch).')';
        }

        if ( count( $columnSearch ) ) {
            $where = $where === '' ?
                implode(' AND ', $columnSearch) :
                $where .' AND '. implode(' AND ', $columnSearch);
        }

        if ( $where !== '' ) {
            $where = 'WHERE '.$where;
        }

        return $where;
    }


    /**
     * Perform the SQL queries needed for an server-side processing requested,
     * utilising the helper functions of this class, limit(), order() and
     * filter() among others. The returned array is ready to be encoded as JSON
     * in response to an SSP request, or can be modified if needed before
     * sending back to the client.
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $sql_details SQL connection details - see sql_connect()
     *  @param  string $table SQL table to query
     *  @param  string $primaryKey Primary key of the table
     *  @param  array $columns Column information array
     *  @param  array $joinQuery Join query String
     *  @param  string $extraWhere Where query String
     *
     *  @return array  Server-side processing response array
     *
     */
    public function simple ( $request,  $table, $primaryKey, $columns, $joinQuery = NULL, $extraWhere = '', $groupBy = '')
    {
        $bindings = array();

        
        // Build the SQL query string from the request
        $limit = $this->limit( $request, $columns );
        $order = $this->order( $request, $columns, $joinQuery );
        $where = $this->filter( $request, $columns, $bindings, $joinQuery );

		// IF Extra where set then set and prepare query
        if($extraWhere)
		{
			$cWhere = ($extraWhere) ?  ' WHERE '.$extraWhere : "";
            $extraWhere = ($where) ? ' AND '.$extraWhere : ' WHERE '.$extraWhere;
			
		}
        $groupBy_sql = ($groupBy) ? ' GROUP BY '.$groupBy .' ' : '';
        
        // Main query to actually get the data
        if($joinQuery){
            $col = self::pluck($columns, 'db', $joinQuery);
            $query =  "SELECT SQL_CALC_FOUND_ROWS ".implode(", ", $col)."
			 $joinQuery
			 $where
			 $extraWhere
			 $groupBy_sql
			 $order
			 $limit";
        }else{
            $query =  "SELECT SQL_CALC_FOUND_ROWS ".implode(", ", self::pluck($columns, 'db'))."
			 FROM $table
			 $where
			 $extraWhere
			 $groupBy_sql
			 $order
			 $limit";
        }

       //echo $query;exit;
         $this->sql = $query;
        $data =  $this->ci->db->query($query)->result_array();


        // Data set length after filtering
        $query_found = $this->ci->db->query('SELECT FOUND_ROWS() AS `Count`');
        $recordsFiltered  = $query_found->row()->Count;

        // Total data set length
        if($groupBy == "")
        {
            $count = "COUNT($primaryKey)";
        }
        else
        {
            $count = "COUNT( DISTINCT $groupBy  ) ";
        }
        $query_total = "SELECT $count as total_rec FROM   $table ";

        if(isset($cWhere))
        {
            $query_total .='  '.$cWhere;

        }


        $resTotalLength = $this->ci->db->query($query_total);
        $recordsTotal   = $resTotalLength->row()->total_rec;
		

        /*
         * Output
         */
        return array(
            "draw"            => intval( $request['draw'] ),
            "recordsTotal"    => intval( $recordsTotal ),
            "recordsFiltered" => intval( $recordsFiltered ),
            "data"            => self::data_output( $columns, $data, $joinQuery )
        );
    }


    /**
     * Connect to the database
     *
     * @param  array $sql_details SQL server connection details array, with the
     *   properties:
     *     * host - host name
     *     * db   - database name
     *     * user - user name
     *     * pass - user password
     * @return resource Database connection handle
     */
    static function sql_connect ( $sql_details )
    {
        try {
            $db = @new PDO(
                "mysql:host={$sql_details['host']};dbname={$sql_details['db']}",
                $sql_details['user'],
                $sql_details['pass'],
                array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION )
            );
            $db->query("SET NAMES 'utf8'");
        }
        catch (PDOException $e) {
            self::fatal(
                "An error occurred while connecting to the database. ".
                "The error reported by the server was: ".$e->getMessage()
            );
        }

        return $db;
    }


    /**
     * Execute an SQL query on the database
     *
     * @param  resource $db  Database handler
     * @param  array    $bindings Array of PDO binding values from bind() to be
     *   used for safely escaping strings. Note that this can be given as the
     *   SQL query string if no bindings are required.
     * @param  string   $sql SQL query to execute.
     * @return array         Result from the query (all rows)
     */
    static function sql_exec ( $db, $bindings, $sql=null )
    {
        // Argument shifting
        if ( $sql === null ) {
            $sql = $bindings;
        }

        $stmt = $db->prepare( $sql );
        //echo $sql;

        // Bind parameters
        if ( is_array( $bindings ) ) {
            for ( $i=0, $ien=count($bindings) ; $i<$ien ; $i++ ) {
                $binding = $bindings[$i];
                $stmt->bindValue( $binding['key'], $binding['val'], $binding['type'] );
            }
        }

        // Execute
        try {
            $stmt->execute();
        }
        catch (PDOException $e) {
            self::fatal( "An SQL error occurred: ".$e->getMessage() );
        }

        // Return all
        return $stmt->fetchAll();
    }


    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Internal methods
     */

    /**
     * Throw a fatal error.
     *
     * This writes out an error message in a JSON string which DataTables will
     * see and show to the user in the browser.
     *
     * @param  string $msg Message to send to the client
     */
    static function fatal ( $msg )
    {
        echo json_encode( array(
            "error" => $msg
        ) );

        exit(0);
    }

    /**
     * Create a PDO binding key which can be used for escaping variables safely
     * when executing a query with sql_exec()
     *
     * @param  array &$a    Array of bindings
     * @param  *      $val  Value to bind
     * @param  int    $type PDO field type
     * @return string       Bound key to be used in the SQL where this parameter
     *   would be used.
     */
    static function bind ( &$a, $val, $type )
    {
        $key = ':binding_'.count( $a );

        $a[] = array(
            'key' => $key,
            'val' => $val,
            'type' => $type
        );

        return $key;
    }


    /**
     * Pull a particular property from each assoc. array in a numeric array,
     * returning and array of the property values from each item.
     *
     *  @param  array  $a    Array to get data from
     *  @param  string $prop Property to read
     *  @param  bool  $isJoin  Determine the the JOIN/complex query or simple one
     *  @return array        Array of property values
     */
    static function pluck ( $a, $prop, $isJoin = false )
    {
        $out = array();

        for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
            $out[] = ($isJoin && isset($a[$i]['as'])) ? $a[$i][$prop]. ' AS '.$a[$i]['as'] : $a[$i][$prop];
        }

        return $out;
    }
}
