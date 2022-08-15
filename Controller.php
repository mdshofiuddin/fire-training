<?php
// static method (getData,getId,onInset,allDataShow,getEditId,updateData,deleteData,totalManPower,totalMale,totalFemale,totalTrainer,fetchData(for Reporting))
// dataFetch method return with fetch assoc which return only last id or row
// percentage for calculate percentage
// exicuteReturn method return without fetch data
// exicute method return true when execute successfully and return false when not execute properly
// test method for testing data with prin_r and exit program

class Controller
{

    public $link;
    public function __construct()
    {
        $this->link = oci_connect('shofi', '123', 'localhost/orcl');
    }

    public function onInsertData()
    // select vemployeeid,vempname,vfatherhisname,empstatus,vdepartmentname,vdesignationname,vunitname,vlinename,vshift,djoiningdate from hrm_vw_employeeinfo
    {
        // $i = 1;
        // $or_name = '';
        // $inter_external ='';

        $fkl_id = $_POST['fkl_id'];
        $organization_name = $_POST['organization_name'];

        //    foreach($organization_name as $org_name){
        //        $or_name .= ','.$org_name;
        //    }

        $training_date = $_POST['training_date'];
        $training_status = $_POST['training_status'];
        $building_name = $_POST['building_name'];
        $floor_name = $_POST['floor_name'];
        $organization_status = $_POST['internal_external'];

        //    foreach($organization_status as $inter_exter){
        //     $inter_external .= ','.$inter_exter;
        // }

        $sql = "INSERT INTO FIRE_TRAINING (SL,FKL_ID,ORGANIZATION_NAME,TRAINING_DATE,BUILDING_NAME,TRAINING_STATUS,ORGANIZATION_STATUS,FLOOR_NAME) VALUES
        ((SELECT NVL(MAX(SL),0)+1 FROM fire_training),'$fkl_id','$organization_name',TO_DATE('$training_date','dd-MM-yyyy'),
        '$building_name','$training_status','$organization_status','$floor_name')";

        // echo $sql;
        //    echo "INSERT INTO FIRE_TRAINING (SL,FKL_ID,ORGANIZATION_NAME,TRAINING_DATE,BUILDING_NAME,TRAINING_STATUS,ORGANIZATION_STATUS,FLOOR_NAME) VALUES
        //    ((SELECT NVL(MAX(SL),0)+1 FROM fire_training),'$fkl_id','$organization_name','$training_date','$building_name','$training_status','$organization_status','$floor_name')";
        $query = oci_parse($this->link, $sql);
        if (oci_execute($query)) {
            // echo "<pre>";
            // print_r($query);
            // exit();       
            oci_close($this->link);
            header('location: index.php');
            return "Successfully Save";
        } else {
            die("Something occurs error");
        }
    }


    public function allDataShow()
    {
        // extract($_POST);
        $sql = "select vemployeeid,vempname,vfatherhisname,empstatus,vdepartmentname,vdesignationname,vunitname,vlinename,vshift,
        djoiningdate,training_status t_status,organization_name org_name,training_date t_date,building_name building,floor_name floor,
        sl from hrm_vw_employeeinfo hr inner join fire_training fire on fire.fkl_id = hr.vemployeeid order by sl desc";
        $query = oci_parse($this->link, $sql);
        if (oci_execute($query)) {
            oci_close($this->link);
            return  $query;
        } else {
            die("No data");
        }
    }


    public function getData($id)
    {
        $sql = "select vemployeeid,vempname,vfatherhisname,vmothersname,empstatus,vdepartmentname,vdesignationname,vunitname,
        vlinename,vshift,djoiningdate,training_status t_status,organization_name org_name,training_date t_date,building_name building,floor_name floor,
        organization_status org_status,vsex from hrm_vw_employeeinfo hr inner join fire_training fire on fire.fkl_id = hr.vemployeeid where sl=$id ";
        $query = oci_parse($this->link, $sql);
        if (oci_execute($query)) {

            oci_close($this->link);
            return $query;
        } else {
            die("Do not show");
        }
    }

    public function getId($id)
    {
        // $sql = "select vemployeeid,vempname,vfatherhisname,vmothersname,empstatus,vdepartmentname,vdesignationname,vunitname,vlinename,vshift,djoiningdate,training_status t_status,organization_name org_name,training_date t_date,building_name building,floor_name floor,organization_status org_status,vsex from hrm_vw_employeeinfo hr inner join fire_training fire on fire.fkl_id = hr.vemployeeid where sl=$id ";
        $sql = "SELECT vemployeeid,vempname,vfatherhisname,vmothersname,vsex,empstatus,vdepartmentname,
        vdesignationname,vunitname,vlinename,vshift,djoiningdate from hrm_vw_employeeinfo where vemployeeid = '$id'";
        $query = oci_parse($this->link, $sql);
        if (oci_execute($query)) {
            oci_close($this->link);
            return $query;
        } else {
            die("Do not show");
        }
    }

    public function getEditId($id)
    {

        $sql = "SELECT * from FIRE_TRAINING where SL = '$id'";
        $query = oci_parse($this->link, $sql);
        if ($queryResult = oci_execute($query)) {
            oci_close($this->link);
            return $query;
        } else {
            die("Do not Save");
        }
    }

    public function updateData($id)
    {
        extract($_POST);

        $sql = "UPDATE FIRE_TRAINING SET FKL_ID = '$fkl_id',ORGANIZATION_NAME='$organization_name',TRAINING_DATE=to_date('$training_date','dd-MM-yyyy'),
        TRAINING_STATUS='$training_status',BUILDING_NAME = '$building_name',FLOOR_NAME='$floor_name', ORGANIZATION_STATUS = '$internal_external' WHERE SL=$sl";
        $query = oci_parse($this->link, $sql);
        if (oci_execute($query)) {
            oci_close($this->link);
            header('location: index.php');
            return "Successfully updated";
        } else {
            die("Do not Save");
        }
    }

    public function deleteData($id)
    {
        extract($_GET);
        $sql = "DELETE FROM FIRE_TRAINING WHERE SL='$id'";
        $query = oci_parse($this->link, $sql);
        if ($queryResult = oci_execute($query)) {
            oci_close($this->link);
            header('location: index.php');
            return "Successfully Delete";
        } else {
            die("Do not Save");
        }
    }

    function fetch_data()
    {
        $output = '';
        $sql = "select vemployeeid,vempname,vfatherhisname,vmothersname,empstatus,vdepartmentname,vdesignationname,
        vunitname,vlinename,vshift,djoiningdate,training_status t_status,organization_name org_name,training_date t_date,building_name building,
        floor_name floor,organization_status org_status,vsex
        from hrm_vw_employeeinfo hr inner join fire_training fire on fire.fkl_id = hr.vemployeeid";
        $query = oci_parse($this->link, $sql);
        oci_execute($query);
        while ($row = oci_fetch_array($query)) {
            $output .= '<tr>  
                                         <td>' . $row["VEMPLOYEEID"] . '</td>  
                                         <td>' . $row["VEMPNAME"] . '</td>  
                                         <td>' . $row["VSEX"] . '</td>  
                                         <td>' . $row["EMPSTATUS"] . '</td>  
                                         <td>' . $row["VDEPARTMENTNAME"] . '</td>  
                                         <td>' . $row["VDESIGNATIONNAME"] . '</td>  
                                         <td>' . $row["VUNITNAME"] . '</td>  
                                         <td>' . $row["VLINENAME"] . '</td>  
                                         <td>' . $row["ORG_NAME"] . '</td>  
                                         <td>' . $row["T_DATE"] . '</td>  
                                         <td>' . $row["BUILDING"] . '</td>  
                                         <td>' . $row["FLOOR"] . '</td>  
                                         <td>' . $row["ORG_STATUS"] . '</td>  
                                    </tr>  
                                         ';
        }
        return $output;
    }

    public function totalManPower()
    {
        $sql = "select count(empstatus) 
                            active from hrm_vw_employeeinfo where empstatus = 'In-Active' ";
        $query = oci_parse($this->link, $sql);
        oci_execute($query);
        $result = oci_fetch_assoc($query);
        return $result;
    }

    public function totalMale()
    {
        $sql = "select count(empstatus) 
                        active,vsex male from hrm_vw_employeeinfo where (empstatus = 'In-Active' and vsex= 'Male') group by vsex ";
        $query = oci_parse($this->link, $sql);
        oci_execute($query);
        $result = oci_fetch_assoc($query);
        return $result;
    }

    public function totalFemale()
    {
        $sql = "select count(empstatus) 
                        active,vsex female from hrm_vw_employeeinfo where (empstatus = 'In-Active' and vsex= 'Female') group by vsex ";
        $query = oci_parse($this->link, $sql);
        oci_execute($query);
        $result = oci_fetch_assoc($query);
        return $result;
    }

    public function totalTrainer()
    {
        $sql = "select count(empstatus)trainer from hrm_vw_employeeinfo hr
         left join fire_training fr on hr.vemployeeid = fr.fkl_id where (fr.training_status='yes' and hr.empstatus='In-Active') group by hr.empstatus ";
        $query = oci_parse($this->link, $sql);
        oci_execute($query);
        $result = oci_fetch_assoc($query);
        return $result;
    }

    // --------------------------------------------------------------------------------------------------------------------------------------------------------------
    // Dynamic Function
    // --------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function exicuteReturn($sql)
    {
        $query = oci_parse($this->link, $sql);
        oci_execute($query);
        oci_close($this->link);
        return $query;
    }

    public function exicute($sql)
    {
        $query = oci_parse($this->link, $sql);
        if (oci_execute($query)) {
            oci_free_statement($query);
            oci_close($this->link);
            return true;
        } else
            return false;
    }

    public function dataFetch($sql)
    {
        $query = oci_parse($this->link, $sql);
        oci_execute($query);
        $result = oci_fetch_assoc($query);
        return $result;
    }

    public function percentage($total, $portion)
    {
        $percent = ($portion * 100) / $total;
        return $percent . "%";
    }

    public function checkDataExistence($query)
    {
        $checkData = oci_parse($this->link, $query);
        oci_execute($checkData);
        $data = oci_fetch_assoc($checkData);
        oci_close($this->link);
        if (oci_num_rows($checkData) == 1) {
            return 'exist';
        } else {
            return 'not exist';
        }
    }

    public function getDataDynamic($query)
    {
        if (!empty($query)) {
            $sql = oci_parse($this->link, $query);
            oci_execute($sql);
            // $row = oci_fetch_assoc($sql);
            while ($row = oci_fetch_assoc($sql)) {
                $data[] = $row;
            }
            oci_free_statement($sql);
            oci_close($this->link);
            return (empty($data) ? 'Table is empty...' : $data);
            //return (empty($data) ? 'Table is empty...' : $row);
        } else {
            return "Parameter $query is empty!";
        }
    }

    // public function delete($sql){
    // 	$deleteData = oci_parse($this->link, $sql);
    //     if(oci_execute($deleteData)){
    //     	oci_free_statement($deleteData);
    //     	oci_close($this->link);
    //     	return true;
    //     }else{
    //     	return false;
    //     }
    // }



    // function orgNameInsert()
    // {
    //     $org_name = $_POST['org_name'];
    //     $sql = "insert into training_center (id,center_name) values ((SELECT NVL(MAX(id),0)+1 FROM training_center),'$org_name')";
    //     $query = oci_parse($this->link, $sql);
    //     oci_execute($query);
    //     if ($query)
    //         return "success";
    //     else
    //         return "failur";
    // }



    function test($value)
    {
        echo "<pre>";
        print_r($value);
        exit();
    }
}
