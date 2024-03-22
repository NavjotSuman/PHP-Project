<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a id="a">
        Wikipedia, a free encyclopedia (opens in another, possibly already existing,
        tab)
    </a>
    <!-- <a href="https://www.wikipedia.org/" target="OpenWikipediaWindow">
        Wikipedia, a free encyclopedia (opens in another, possibly already existing,
        tab)
    </a> -->


    <script>
        let a = document.getElementById("a");
        // console.log(a);
        a.addEventListener('click', () => {
            window.open("https://google.com", "newWindow","popup, width=900, height= 500")
        })
    </script>
</body>

</html>