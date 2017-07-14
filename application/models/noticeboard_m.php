<?php
class Noticeboard_m extends CI_Model {
 
    function __construct()
    {       
        parent::__construct();
    }

    public function create_m($posts)
    {
    	$queryst = "INSERT INTO noticeboard (`num`, `title`, `contents`,`date`,`user_num`,`user_file`) VALUES ('','$posts[title]', '$posts[contents]','$posts[date]','$posts[unum]','$posts[ufile]');";
    	$this->db->query($queryst);
      return $this->db->insert_id();

    }

   	public function read_m($type='',$start='',$limit='')
   	{	
      if ($limit != '' OR $start != '') 
      {
        
        $queryst = "select  A.num, A.title, B.nickname , A.date from   noticeboard A 
                  left join data B
                  on A.user_num = B.num ORDER BY num DESC LIMIT $start,$limit ";
                }
      else 
         $queryst = "select  A.num, A.title, B.nickname , A.date from   noticeboard A 
                  left join data B
                  on A.user_num = B.num ORDER BY num DESC";
      if($type =='count')
      {
        return $this->db->query($queryst)->num_rows();
      }
      else
      {
        return $this->db->query($queryst)->result_array();
      }
   		   
   	}
    public function search_m($type='',$start='',$limit='',$serchinfo='')
    { 
      if ($limit != '' OR $start != '') 
      {           
                if($serchinfo['searchlist']=='title_contents')
                  $queryst = "select  A.num, A.title, B.nickname , A.date from   noticeboard A 
                  left join data B
                  on A.user_num = B.num  
                  WHERE (contents LIKE '%$serchinfo[searchcontents]%' 
                  or title LIKE '%$serchinfo[searchcontents]%')
                  and user_file >= $serchinfo[searchfile] 
                  ORDER BY num DESC LIMIT $start,$limit ";
               
                 else 
                  $queryst = "select  A.num, A.title, B.nickname , A.date from   noticeboard A 
                  left join data B
                  on A.user_num = B.num  
                  WHERE $serchinfo[searchlist] LIKE '%$serchinfo[searchcontents]%' and user_file >= $serchinfo[searchfile] 
                  ORDER BY num DESC LIMIT $start,$limit ";
              
                  
      }
      else 
                  if($serchinfo['searchlist']=='title_contents')
                  $queryst = "select  A.num, A.title, B.nickname , A.date from   noticeboard A 
                  left join data B
                  on A.user_num = B.num  
                  WHERE (contents LIKE '%$serchinfo[searchcontents]%' 
                  or title LIKE '%$serchinfo[searchcontents]%')
                  and user_file >= $serchinfo[searchfile] 
                  ORDER BY num DESC ";
                  else
                  $queryst = "select  A.num, A.title, B.nickname , A.date from   noticeboard A 
                  left join data B
                  on A.user_num = B.num 
                  WHERE $serchinfo[searchlist] LIKE '%$serchinfo[searchcontents]%' and
                  user_file >= $serchinfo[searchfile]
                  ORDER BY num DESC";
      if($type =='count')
      {
        return $this->db->query($queryst)->num_rows();
      }
      else
      {
        return $this->db->query($queryst)->result_array();
      }
         
    }

   	public function findboard($num)
   	{
   		$queryst="
                select  A.num, A.contents, A.title, B.nickname , A.date, A.user_file, C.filename
                from   noticeboard A 
                left join data B 
                on A.user_num = B.num
                left join noticeboardfile C
                on A.num = C.filenum
                where A.num=$num;";
   		return $this->db->query($queryst)->result_array();
   	}

    public function confirm($info)

    {
      $queryst = "SELECT * FROM noticeboard WHERE num = '$info[num]' and user_num='$info[unum]' ; ";
      if($this -> db-> query($queryst)->num_rows()>0){
        return TRUE;
      }
      else
        return FAlSE;

    }

    public function deleteboard($info)
    {
      $queryst="DELETE from noticeboard  WHERE num='$info[num]' and user_num='$info[unum]';";
      $this -> db ->query($queryst);

    }

    public function updatevalue($num)
    {
      $queryst="SELECT num,title,contents FROM noticeboard WHERE num= '$num';";
      return $this->db->query($queryst)->result_array();
    }

    public function updatestore($updateinfo)
    {
      $queryst="UPDATE noticeboard SET title='$updateinfo[title]', contents = '$updateinfo[contents]' WHERE  num=$updateinfo[num];";
      $this -> db ->query($queryst);
    }

   public function filecreate($fileinfo)
    {
      $queryst = "INSERT INTO noticeboardfile (`filenum`,`filename`) VALUES ('$fileinfo[filenum]', '$fileinfo[filename]');";
      $this->db->query($queryst);

    }
}
?>