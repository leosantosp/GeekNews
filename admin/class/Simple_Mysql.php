<?php

class Simple_Mysql implements Persistence{

	private $conexao;

        private $data;

	public function __construct()

	{

            $this->conexao = mysqli_connect(persistence::HOST, persistence::USER, persistence::PASSWORD);

            mysqli_select_db($this->conexao,persistence::DBNAME);

            $this->data['operador']= '=';

	}

                public function __set($name, $value) {

            $this->data[$name] = $value;

        }

                public function __get($name) {

            return $this->data[$name];

        }

        	public function execute($sql=null)

	{

            if($sql==null):

                if($this->data['sql']!==null):

                    $query_res = mysqli_query($this->conexao,$this->data['sql']);

                    return $query_res;

                else:

                    return false;

                endif;

            else:

                $query_res = mysqli_query($this->conexao,$sql);

                return $query_res;

            endif;

            





	} 

        	public function insert()

	{

                    if(is_array($this->data['table'])):

                       $table_array = $this->data['table'];

                        $table = $table_array[0];

                    else:

                        $table = $this->data['table'];

                    endif;

                        $column = $this->data['column'];

                        if(key_exists(0, $column)):

                            unset($column[0]);

                        endif;

                        

                        $number_column = count($column);

                        $count_column =1;

                        $column_name ='';

                        $column_content ='';

                        

                    foreach ($column as $key => $value):

                            $column_name.="$key";

                            $column_content .="'$value'";

                        if(($number_column>$count_column)&&!is_numeric($key)):

                            $column_name.=", ";

                            $column_content.=", ";

                        endif;

                        $count_column++;

                    endforeach;



           $this->data['sql'] = "INSERT INTO ".  self::DBNAME.".".  self::PREFIX.$table." ($column_name) VALUES ($column_content)";



	}  

        	public function update()

	{

                    $operador = $this->data['operador'];

                    if(is_array($this->data['table'])):

                       $table_array = $this->data['table'];

                        $table = $table_array[0];

                    else:

                        $table = $this->data['table'];

                    endif;

                        $column = $this->data['column'];

                        $where = $this->data['where'];

                        

                        if(key_exists(0, $column)):

                            unset($column[0]);

                        endif;

                        

                        $number_column = count($column);

                        $count_column =1;

                        $column_update ='';

                    foreach ($column as $key => $value):

                            $column_update.="$key = '$value'";

                        if($number_column!=$count_column):

                            $column_update.=", ";

                        endif;

                        $count_column++;

                    endforeach;

                    

                        $number_where = count($where);

                        $count_where =1;

                        $column_where ='';

                    foreach ($where as $key => $value):

                        if(!is_numeric($key)):

                             $column_where.="".  self::PREFIX.$table.".$key ".$operador." '$value'";

                        else:

                            $column_where.=" $value ";

                        endif;

                            

                        if($number_where!=$number_where && !is_numeric($key)):

                            $column_where.=", ";

                        endif;

                        $count_where++;

                    endforeach;



             $this->data['sql'] = "UPDATE ".  self::DBNAME.".".  self::PREFIX.$table." SET $column_update WHERE $column_where";

	} 

        	public function delete()

	{

                    if(is_array($this->data['table'])):

                       $table_array = $this->data['table'];

                        $table = $table_array[0];

                    else:

                        $table = $this->data['table'];

                    endif;

                    $where = $this->data['where'];

                        $number_where = count($where);

                        $count_where =1;

                        $column_where ='';

                    foreach ($where as $key => $value):

                        if(!is_numeric($key)):

                            $column_where.="".  self::PREFIX.$table.".$key = '$value'";

                        else:

                            $column_where.=" $value ";

                        endif;

                            

                        if($number_where!=$number_where && !is_numeric($key)):

                            $column_where.=", ";

                        endif;

                        $count_where++;

                    endforeach;



          $this->data['sql'] = "DELETE FROM ".  self::DBNAME.".".  self::PREFIX.$table." WHERE $column_where";

	} 

        	public function select()

	{           $operador = $this->data['operador'];

                    if(is_array($this->data['table'])):

                       $table_array = $this->data['table'];

                        $table = $table_array[0];

                    else:

                        $table = $this->data['table'];

                    endif;

                        $where = ( isset($this->data['where']))? $this->data['where']:'';

                        $column = $this->data['column'];



                        $number_column = count($column);

                        $count_column =1;

                        $column_select ='';

                        $column_alias='';

                        

                    foreach ($column as $key => $value):

                        if($value!=null&&$value!=''&&!is_numeric($key)):

                            $column_alias="AS '$value' ";

                        else:

                            $column_alias="";

                        endif;

                        if(!is_numeric($key)):

                            $column_select.="".  self::PREFIX.$table.".$key $column_alias";

                        else:

                            $column_select.="".  self::PREFIX.$table.".$value $column_alias";

                        endif;

                        



                        if($number_column!=$count_column):

                            $column_select.=", ";

                        endif;

                        $count_column++;

                    endforeach;

                        // $number_where = count($where);

                        $count_where =1;

                        $column_where ='';

                        if(is_array($where)):

                            $column_where ='WHERE ';

                            foreach ($where as $key => $value):

                                if(!is_numeric($key)):

                                    $column_where.="".  self::PREFIX.$table.".$key ".$operador." '$value'";

                                else:

                                    $column_where.=" $value ";

                                endif;



                                // if($number_where!=$number_where && !is_numeric($key)):

                                //     $column_where.=", ";

                                // endif;

                                $count_where++;

                            endforeach;

                        endif;

                    $groupby = (isset($this->data['groupby']))?

                            "GROUP BY ".self::PREFIX.$table.".".$this->data['groupby']."" :'';

                    $order = (isset($this->data['order']))?$this->data['order'] :'';

                    

                    $limit = (isset($this->data['limit']))?" LIMIT ".$this->data['limit'] : '';

                    $offset = (isset($this->data['limit'])&&isset($this->data['offset']))?" OFFSET ".$this->data['offset'] :'';

                    $this->data['sql'] = "SELECT $column_select FROM ".  self::DBNAME.".".  self::PREFIX.$table."  $column_where "." $groupby $order $limit $offset";

	}

        	public function get_connect()

	{

            return $this->conexao;



	}

            public function insert_id()

    {

            return mysqli_insert_id($this->get_connect());

    }





        

       

}