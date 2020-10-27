<!-- start left-sidenav-->
<div class="left-sidenav">
    <ul class="metismenu left-sidenav-menu nav">
        <li><a href="dashboard.php" class="active"><i class="ti-dashboard"></i><span>Dashboard</span></a></li>
        <li><a href="AddAsset.php"><i class="ti-bag"></i><span>Add Asset</span></a></li>
        <li><a href="AssetIn.php"><i class="ti-import"></i><span>Asset In</span></a></li>
        <li><a href="AssetAssign.php"><i class="ti-export"></i><span>Asset Assign</span></a></li>
        <li><a href="AssetStock.php"><i class="ti-layers-alt"></i><span>Asset Stock</span></a></li>

    </ul>
</div>

<!-- end left-sidenav-->

<script src="assets/js/jquery.min.js"></script>

<script>
$(function() {
    $('.nav li a').filter(function() {
        return this.href == location.href
    }).parent().addClass('active').siblings().removeClass('active')
    $('.nav li a').click(function() {
        $(this).parent().addClass('active').siblings().removeClass('active')
    })
})
</script>