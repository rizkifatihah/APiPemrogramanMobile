<?php
require_once "koneksi.php";
class Mahasiswa 
{
 
   public  function get_mhss()
   {
      global $mysqli;
      $query="SELECT * FROM mahasiswa";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get List Mahasiswa Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   public function get_mhs($nim=0)
   {
    global $mysqli;
    $query="SELECT * FROM mahasiswa";
    if($nim != 0)
    {
        $query.=" WHERE nim=".$nim." LIMIT 1";
    }
    $data=array();
    $result=$mysqli->query($query);
    while($row=mysqli_fetch_object($result))
    {
        $data[]=$row;
    }
    if($data){
    $response=array(
            'status' => 1,
            'message' =>'Get Mahasiswa Successfully.',
            'data' => $data
        );
    }else{
        $response=array(
            'status' => 0,
            'message' =>'Get Mahasiswa Failed.',
            'data' => $data
            );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
        
   }
 
   public function insert_mhs()
    {
        global $mysqli;
        $arrcheckpost = array('nama' => '', 'nim' => '', 'email' => '', 'fakultas' => '', 'prodi'   => '', 'semester'   => '', 'statusmhs'   => '', 'foto'   => '');
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if($hitung == count($arrcheckpost)){
        
            $result = mysqli_query($mysqli, "INSERT INTO mahasiswa SET
            nama = '$_POST[nama]',
            nim = '$_POST[nim]',
            email = '$_POST[email]',
            fakultas = '$_POST[fakultas]',
            prodi = '$_POST[prodi]',
            semester = '$_POST[semester]',
            statusmhs = '$_POST[statusmhs]',
            foto = '$_POST[foto]'");
            
            if($result)
            {
                $response=array(
                    'status' => 1,
                    'message' =>'Mahasiswa Added Successfully.'
                );
            }
            else
            {
                $response=array(
                    'status' => 0,
                    'message' =>'Mahasiswa Addition Failed.'
                );
            }
        }else{
        $response=array(
                    'status' => 0,
                    'message' =>'Parameter Do Not Match'
                );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
 
   function update_mhs($id)
      {
         global $mysqli;
         $arrcheckpost = array('nama' => '', 'nim' => '', 'email' => '', 'fakultas' => '', 'prodi'   => '', 'semester'   => '', 'statusmhs'   => '', 'foto'   => '');
         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
          
              $result = mysqli_query($mysqli, "UPDATE mahasiswa SET
                nama = '$_POST[nama]',
                nim = '$_POST[nim]',
                email = '$_POST[email]',
                fakultas = '$_POST[fakultas]',
                prodi = '$_POST[prodi]',
                semester = '$_POST[semester]',
                statusmhs = '$_POST[statusmhs]',
                foto = '$_POST[foto]',
              WHERE id='$id'");
          
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Mahasiswa Updated Successfully.'
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Mahasiswa Updation Failed.'
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function delete_mhs($id)
   {
      global $mysqli;
      $query="DELETE FROM mahasiswa WHERE id=".$id;
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Mahasiswa Deleted Successfully.'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Mahasiswa Deletion Failed.'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
}
 
 ?>