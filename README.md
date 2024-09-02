control.php: lay ke hoach co thuc hien < kehoach

--Redirect
---- http://localhost/hoathodh/sanxuatdh/index.php :
header("Location: http://localhost:8000/sanxuat") ;

--- http://localhost/hoathodh/kcs/dailyreport.php
--- http://localhost/hoathodh/kcs/control.php
header("Location: http://localhost:8000/kcs");

---- http://localhost/hoathodh/sanxuatdh/history.php
header("Location: http://localhost:8000/sanxuat/ket-thuc");

---- http://localhost/hoathodh/sanxuatdh/waiting.php
header("Location: http://localhost:8000/kehoach");

---- http://localhost/hoathodh/sanxuatdh/lineinfo.php?chuyen=01
header("Location: http://localhost:8000/kcs/XN1_02");

if (strlen($chuyen) == 2) {
header("Location: http://localhost:8000/kcs/XN1_$chuyen");
} else {
$chuyenX2 = explode(".", $chuyen);
$new = $chuyenX2[1];
header("Location: http://localhost:8000/kcs/XN2_$new");
}
