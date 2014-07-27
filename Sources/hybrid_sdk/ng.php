<script>
/*
 * App for angular
 */

(function() {
    // Declare a controller
    var app = angular.module( 'myModule', []);
    
    // Declare a controller
    app.controller('getUserProfile', function() {
        this.user = <?php if (isset($data)) { echo $data; } else { echo '{}';} ?> ;
    });
})();
</script>