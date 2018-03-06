<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        li {
            list-style: none;
        }
        .child-li, .child-btn {
            display: inline-table;
        }
        .child-btn {
            display: none;
        }
    </style>
</head>
<body>
    <ul>
        <li class="parent">
            <ul class="child">
                <li class="child-li">Day la noi dung 1</li>
                <li class="child-btn">
                    <button class="btn">Btn</button>
                </li>
            </ul>
        </li>
        <li class="parent">
            <ul class="child">
                <li class="child-li">Day la noi dung 2</li>
                <li class="child-btn">
                    <button class="btn">Btn</button>
                </li>
            </ul>
        </li>
    </ul>

    <script type="text/javascript">
        var child = document.getElementsByClassName('child-li');
        
        for (var i = 0; i < child.length; i++) {
            child[i].addEventListener("mouseover", function(event){
                this.nextElementSibling.setAttribute("style", "display:inline-block");
            });

            // child[i].addEventListener("mouseout", function(event){
            //     this.nextElementSibling.setAttribute("style", "display:none");
            // });
        }
    </script>
</body>
</html>