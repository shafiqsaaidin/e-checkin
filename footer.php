    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/myjs.js"></script>
    <script>
        var $scores = $("#mytable");
            setInterval(function () {
            $scores.load("index.php #mytable");
        }, 1000);
        var $adminTable = $("#admin-table");
            setInterval(function () {
            $adminTable.load("admin_dashboard.php #admin-table");
        }, 1000);
        var $dashboard = $("#dashboard");
          setInterval(function(){
            $dashboard.load("admin_dashboard.php #dashboard");
          }, 1000);
    </script>
</html>
