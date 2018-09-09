<?php
/**
 * Created by PhpStorm.
 * User: 19502
 * Date: 2018/7/30
 * Time: 20:16
 */

echo"<meta charset='utf-8'>";
if (isset($_POST['abstract'])){
    include("sqlhelper.php");
    $mysqli=new sqlhelper();
    date_default_timezone_set('Asia/Shanghai');
    if(isset($_POST['article2'])&&isset($_POST['abstract']))
    {
        $title = $_POST['article2'];
        $content = $_POST['abstract'];
        $time = $_POST['time'];

    }

//$sql = "INSERT INTO school (id,title, content, time) VALUES ('$id','$title','$content','$time')";
    $sql="INSERT INTO announcement (title,content,time)VALUES('$title','$content','$time')";
    $res=$mysqli->execute_dql($sql);
    if(!$res)
    {
        echo"<script>alert('上传失败')</script>";
    }
    else
        echo"<script>alert('上传成功')</script>";

    $name = $_FILES['file-2']['name'];
    $file_data = $_FILES['file-2']['tmp_name'];

    if (is_array($name))
    {

        $str="SELECT id FROM announcement WHERE content='$content'";
        $res=$mysqli->execute_dql($str);
        $row=$res->fetch_row();
        if($row)
        {
            for ($i = 0; $i < count($name); $i++) {
                $sql = "INSERT INTO announcement_file(announcement_id,file_name) VALUES('$row[0]','$name[$i]')";
                $res = $mysqli->execute_dql($sql);
                if (!$res) {
                    echo "<script>alert('上传失败')</script>";
                }
                $upload_path = "../announcement/file/";
                $path = $upload_path . $name[$i];
                $file_path = move_uploaded_file($file_data[$i], $path);
                if ($file_path == false) {
                    echo "<script>alert('文件保存失败！');</script>";
                }
            }

        }
    }
    echo "<script>window.location.href='announcement.php'</script>";
}


?>
<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="../images/favicon.ico" >
    <link rel="Shortcut Icon" href="../images/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="lib/html5shiv.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--/meta 作为公共模版分离出去-->

    <title>发布公告</title>
    <link href="lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form class="form form-horizontal" action="announcement_add.php" method="post" enctype="multipart/form-data" >
    <article class="page-container">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">资讯附件（多个附件请按住control一起上传）：</label>
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
			<span class="btn-upload form-group">
			<input class="input-text upload-url" type="text" name="uploadfile-2" id="uploadfile-2" readonly style="width:200px">
			<a data-href="javascript:void();" class="btn btn-primary upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择文件</a>
			<input type="file"  name="file-2[]" class="input-file" multiple>
			</span>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">公告标题：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="article2">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">发布时间：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input name="time" type="text" class="demo-input input-text" placeholder="请选择日期" id="test1">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">公告内容：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea name="abstract" cols="" rows="" class="textarea"  placeholder="" datatype="*10-100" dragonfly="true" nullmsg="不能为空！"></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 发布</button>
                <button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>

    </article>
</form>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script src="layDate-v5.0.9/laydate/laydate.js"></script>
<script type="text/javascript">
    $(function(){
        lay('#version').html('-v'+ laydate.v);

        //执行一个laydate实例
        laydate.render({
            elem: '#test1' //指定元素
        });
        //表单验证
        $("#form-article-add").validate({
            rules:{
                articletitle:{
                    required:true,
                },
                articletitle2:{
                    required:true,
                },
                abstract:{
                    required:true,
                }
            },
            onkeyup:false,
            focusCleanup:true,
            success:"valid",
        });


        // 避免重复创建
    });

</script>
</body>
</html>
