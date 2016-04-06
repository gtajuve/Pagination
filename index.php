<?php
require_once 'Paginator.php';
$conn=mysqli_connect('localhost','Joro','qwerty','sportblog');
$sql="SELECT * FROM teams ORDER BY country_id,team_name ASC ";
$sqlCnt="SELECT COUNT(*) as cnt FROM teams " ;

$rq=mysqli_query($conn,$sqlCnt);
$total=(int)$rq->fetch_assoc()['cnt'];
$paginator=new Paginator();
$paginator->setTotal($total);
$perPage=(isset($_GET['perPage'])?$_GET['perPage']:5);
$paginator->setLimit($perPage);
$page=(isset($_GET['page'])?$_GET['page']:1);
$paginator->setPage($page);
if($perPage!='all'){
    $sql.='LIMIT '.(($paginator->getPage()-1)*$paginator->getLimit()).' , '.$paginator->getLimit();
}

var_dump($sql);
$rq=mysqli_query($conn,$sql);
$teams=array();
while($row=$rq->fetch_assoc()){
    $teams[]=$row;
}


?>
<html lang="en"><head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>Pagination</title>
    <style>
        ul.pagination {
            display: inline-block;
            padding: 0;
            margin: 0;
        }

        ul.pagination li {display: inline;}

        ul.pagination li a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }
    </style>

</head>


<body>
<div>
    <fieldset>
        <form action="">
        <label for="">per Page:
            <select id="selectError3" name="perPage">
                <option value="0" <?php echo ($perPage == 0)? "selected" : " " ?>>-- Select Order --</option>
                <option value="5" <?php echo ($perPage == 5)? "selected" : " " ?>>5 per page</option>
                <option value="10" <?php echo ($perPage == 10)? "selected" : " " ?>>10 per page</option>
                <option value="20" <?php echo ($perPage == 20)? "selected" : " " ?>>20 per page</option>
                <option value="50" <?php echo ($perPage == 50)? "selected" : " " ?>>50 per page</option>
            </select>
            <input type="hidden" value="$page">
            <button type="submit" name="">Filter</button>
        </form>
        </label>
    </fieldset>
    <table>
        <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Stadium</th>

        </tr>
        </thead>
        <tboby>
            <?php foreach($teams as $team):?>
                <tr>
                    <td><img src="<?=$team['image']; ?>" alt="" width="50px" height="50px"></td>
                    <td><?=$team['team_name']; ?></td>

                    <td><?=$team['address'] ?></td>

                </tr>
            <?php endforeach;?>
        </tboby>
    </table>
</div>
<div>
    <?=$paginator->create(2); ?>
</div>
</body>
</html>
