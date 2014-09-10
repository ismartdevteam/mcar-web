<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/mcar/server/lib/config.php";

class Query {

    public static function Login($username, $password) {
        $db = DataBase::getInstance();
        $query = "select username,id,userType from user where username = '$username' and password = '$password'";
        $check = $db->query($query);
        if ($check) {
            if ($check->num_rows > 0) {
                $result = Error_message::Error_number(1000);
                $result["data"] = mysqli_fetch_assoc($check);
            } else {
                $result = Error_message::Error_number(1001);
            }
        } else {
            $result = Error_message::Error_number(2001);
        }
        return $result;
    }

    public static function getCar() {
        $db = DataBase::getInstance();
        $query = "select s.id as seller_id, s.name as seller_name, c.id as id,mark.id mark_id,mark.name as mark_name ,cat.id category_id,cat.name as category_name,m.id model_id,m.name as model,body.id body_id,body.name as body_name,
     c.modification,c.status,c.transmission,c.distance,dr.name as drivetrain,c.engine,c.price,c.fuel,c.viewcount, c.created_date,
            c.image_url ,c.order from car c left join body on c.body_id=body.id
 left join category_car  cat on c.category_car_id=cat.id left join model m on c.model_id=m.id 
left join mark on mark.id=m.mark_id  left join seller as s on c.seller_id=s.id
 left join drivetrain as dr on dr.id =c.drivetrain_id order by c.order,cat.id,c.created_date desc; ";
        $check = $db->query($query);
        if ($check) {
            if ($check->num_rows > 0) {
                $result = Error_message::Error_number(1000);
                $carId = 0;
                $carIndex = -1;

                $imageId = 0;
                $imageIndex = -1;
                $subrow = array();
                while ($rows = mysqli_fetch_assoc($check)) {
                    $subrow[]=$rows;
//                    if ($carId != $rows['carId']) {
//                        $carIndex++;
//                        $imageIndex = -1;
//                        $carId = $rows['carId'];
//                        $subrow[$carIndex]['car_id'] = $carId;
//                        $subrow[$carIndex]['seller_id'] = $rows['seller_id'];
//                        $subrow[$carIndex]['seller_name'] = $rows['seller_name'];
//                        $subrow[$carIndex]['mark'] = $rows['markName'];
//                        $subrow[$carIndex]['cat'] = $rows['catName'];
//                        $subrow[$carIndex]['model'] = $rows['model'];
//                        $subrow[$carIndex]['body'] = $rows['bName'];
//                        $subrow[$carIndex]['modification'] = $rows['modification'];
//                        $subrow[$carIndex]['status'] = (int) $rows['status'];
//                        $subrow[$carIndex]['transmission'] = (int) $rows['transmission'];
//                        $subrow[$carIndex]['distance'] = (int) $rows['distance'];
//                        $subrow[$carIndex]['drivetrain'] = (int) $rows['drivetrain'];
//                        $subrow[$carIndex]['engine'] = (int) $rows['engine'];
//                        $subrow[$carIndex]['price'] = (int) $rows['price'];
//                        $subrow[$carIndex]['fuel'] = (int) $rows['fuel'];
//                        $subrow[$carIndex]['created_date'] = $rows['created_date'];
//                        $subrow[$carIndex]['count'] = (int) $rows['viewcount'];
//                        $subrow[$carIndex]['image'] = array();
//                    }
//                    if ($imageId != $rows['image_id']) {
//                        $imageIndex++;
//                        $imageId = $rows['image_id'];
//                        $subrow[$carIndex]['image'][$imageIndex]['image'] = $rows['image'];
//                    }
                }
                $result['data'] = $subrow;
            } else {
                $result = Error_message::Error_number(1001);
            }
        } else {
            $result = Error_message::Error_number(2001);
        }
        return $result;
    }

    public static function getCompany() {
        $db = DataBase::getInstance();
        $query = "select c.* ,ct.id type_id,ct.name type_name  from company c "
                . "left  join company_type ct on c.type_id=ct.id  order by c.order,ct.id asc;";
        $check = $db->query($query);
        if ($check) {
            if ($check->num_rows > 0) {
                $result = Error_message::Error_number(1000);
                $comId = 0;
                $carIndex = -1;
                $imageId = 0;
                $imageIndex = -1;
                $subrow = array();
                while ($rows = mysqli_fetch_assoc($check)) {

                    $subrow[]=$rows;
                   
                }
                $result['data'] = $subrow;
            } else {
                $result = Error_message::Error_number(1001);
            }
        } else {
            $result = Error_message::Error_number(2001);
        }
        return $result;
    }

    public static function getAds($index) {
        $perPage = 10;
        $db = DataBase::getInstance();
        $query = " select a.id ,c.id category_id,
c.name category_name,a.title,a.desc,a.price,a.phone,a.created_date,a.code, a.images, a.order_status 
from ads a
left join category_car c on a.category_car_id=c.id 
 order by a.order_status asc, a.created_date desc limit $index,$perPage;";
        $check = $db->query($query);
        if ($check) {
            $numData = $check->num_rows;
            if ($numData > 0) {
                $result = Error_message::Error_number(1000);
                $subrow = array();
                while ($rows = mysqli_fetch_assoc($check)) {
                    $subrow[] = $rows;
                }
                $result['number_row'] = count($subrow);
                $result['data'] = $subrow;
            } else {
                $result = Error_message::Error_number(1001);
            }
        } else {
            $result = Error_message::Error_number(2001);
        }
        return $result;
    }

    public static function getSeller($id) {
        $perPage = 10;
        $db = DataBase::getInstance();
        $query = "select s.*, img.id img_id,img.img image_url from seller s left 
join image_seller img on s.id=img.seller_id where s.id=$id;";
        $check = $db->query($query);
        if ($check) {
            if ($check->num_rows > 0) {
                $result = Error_message::Error_number(1000);
                $sellerID = 0;
                $sellerIndex = -1;
                $imageId = 0;
                $imageIndex = -1;
                $subrow = array();
                while ($rows = mysqli_fetch_assoc($check)) {

                    if ($sellerID != $rows['id']) {
                        $sellerIndex++;
                        $imageIndex = -1;
                        $sellerID = $rows['id'];
                        $subrow[$sellerIndex]['id'] = $sellerID;
                        $subrow[$sellerIndex]['name'] = $rows['name'];
                        $subrow[$sellerIndex]['contact'] = $rows['contact'];
                        $subrow[$sellerIndex]['phone'] = $rows['phone'];
                        $subrow[$sellerIndex]['location'] = $rows['location'];
                        $subrow[$sellerIndex]['viewcount'] = $rows['viewcount'];

                        $subrow[$sellerIndex]['image'] = array();
                    }
                    if ($imageId != $rows['img_id']) {
                        $imageIndex++;
                        $imageId = $rows['img_id'];
                        $subrow[$sellerIndex]['image'][$imageIndex]['image_url'] = $rows['image_url'];
                    }
                }
                $result['data'] = $subrow;
            } else {
                $result = Error_message::Error_number(1001);
            }
        } else {
            $result = Error_message::Error_number(2001);
        }
        return $result;
    }

    public static function getDeleteAds($id) {

        $db = DataBase::getInstance();

        $check = $db->query(sprintf("DELETE FROM ads WHERE code='%s'", mysql_real_escape_string($id)));
        if ($check) {
            if ($db->affected_rows > 0)
                $result = Error_message::Error_number(1000);
            else
                $result = Error_message::Error_number(1001);
        } else {
            $result = Error_message::Error_number(2001);
        }
        return $result;
    }

}
