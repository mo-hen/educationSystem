<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>课时播放</title>
    <style type="text/css">

        img{
            display: block;
            margin: 0 auto;
            width: 60%;
        }
        .desc {
            width: 320px;
            position: fixed;
            bottom: 50px;
            left: 42px;
            background-color: #ccc;
            opacity: 0.6;
        }
       .lesson_desc{
           text-indent: 2em;
           line-height: 16px;
       }
    </style>
</head>
<body>
        <img  src="{{$lesson->cover_img}}">
        <div class="desc">
            <label>课程简介：</label>
            <p name="lesson_desc" class="lesson_desc">
                {{$lesson->lesson_desc}}
            </p>
        </div>


</body>
</html>