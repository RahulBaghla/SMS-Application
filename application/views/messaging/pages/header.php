<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $this->session->userdata('userTitle') ?></title>
	<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<!-- Include Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Style -->
	<style type="text/css">
		body {
  font-family: "Roboto Condensed", Helvetica, sans-serif;
  background-color: #f7f7f7;
}
.container {
  margin: 50px auto;
  max-width: 1350px;
}
a {
  text-decoration: none;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  margin-bottom: 20px;
}
table,
th,
td {
  border: 1px solid #bbb;
  text-align: left;
}
tr:nth-child(even) {
  background-color: #f2f2f2;
}
th {
  background-color: #ddd;
}
th,
td {
  padding: 5px;
}
button {
  cursor: pointer;
}
/*Initial style sort*/
.tablemanager th.sorterHeader {
  cursor: pointer;
}
.tablemanager th.sorterHeader:after {
  content: " \f0dc";
  font-family: "FontAwesome";
}
/*Style sort desc*/
.tablemanager th.sortingDesc:after {
  content: " \f0dd";
  font-family: "FontAwesome";
}
/*Style sort asc*/
.tablemanager th.sortingAsc:after {
  content: " \f0de";
  font-family: "FontAwesome";
}
/*Style disabled*/
/* .tablemanager th.disableSort {

} */
#for_numrows {
  padding: 10px;
  float: left;
}
#for_filter_by {
  padding: 10px;
  float: right;
}
#pagesControllers {
  display: block;
  text-align: center;
}

header {
  height: 60px;
  background-color: #f2f2f2;
  box-shadow: 0 0 10px #000;
}

ul {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  padding: 15px;
  position: relative;
}

ul li {
  display: inline;
  list-style: none;
}

ul li a {
  text-decoration: none;
  color: #000000;
  font-size: 18px;
  padding: 0px 0px 0px 20px;
}

@media(max-width:800px){
  header{
    height: 90px;
    text-align: center;
  }
  ul {
  display: flex;
  flex-direction: column;
  padding: 20px;
  position: relative;
} 
 #links{
   padding: 5px;
 }
}

	</style>
</head>
<body>