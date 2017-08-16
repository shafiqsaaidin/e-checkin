    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/myjs.js"></script>
    <script>
      var $clock = $("#clock");
      var $scores = $("#mytable");
      var $adminTable = $("#admin-table");
      var $dashboard = $("#dashboard");
      $(document).ready(function(){
        setInterval(function() {
          $clock.load("index.php #clock");
          $scores.load("index.php #mytable");
          //$adminTable.load("admin_dashboard.php #admin-table");
          $dashboard.load("admin_dashboard.php #dashboard");
        }, 1000);
      });

      $('#search_field').on('keyup', function() {
      var value = $(this).val();
      var patt = new RegExp(value, "i");

      $('#myTable').find('tr').each(function() {
        if (!($(this).find('td').text().search(patt) >= 0)) {
          $(this).not('.myHead').hide();
        }
        if (($(this).find('td').text().search(patt) >= 0)) {
          $(this).show();
        }

      });
      });
    </script>
</html>
