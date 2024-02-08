<?php

/** @var yii\web\View $this */
/** @var string $content */
use yii;
use app\assets\AdminAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\IdentityInterface;
use yii\bootstrap5\Alert;


AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>


<?php $this->beginBody() ?>

<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="<?= Url::to(['/studyRepo/paper/index']) ?>">StudyRepo</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto me-3 me-lg-4">
            <!-- Add other navigation items here if needed -->
        </ul>
    </div> 
    <!-- Close the navbar-collapse div here -->
   

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>

                    <?php if(!yii::$app->user->getIsGuest()) {
                   echo yii::$app->user->identity->username;
                    } ?>
                </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>   <a class="dropdown-item" href="<?= Url::to(['user/request-password-reset']) ?>">Reset password</a></li>
                        
                        <?php if(!yii::$app->user->getIsGuest()) { ?>
    
    <a class="dropdown-item" href="<?= Url::to(['/studyRepo/admin/logout']) ?>"> logout  
   
 </a>

<?php } else {   ?>   

    <a class="dropdown-item" href="<?= Url::to(['/studyRepo/admin/login']) ?>"> login   </a>
<?php } ?>
                    </ul>
                </li>
            </ul>
 

</nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading" >
                           
                    <?php if(!yii::$app->user->getIsGuest()) {
                   echo yii::$app->user->identity->username;
                     ?>
                    <?php } else {   ?>   
                        <p>Guest</p>
                        <?php } ?>
                        </div>
                        <a class="nav-link" href="<?= url::to(['/studyRepo/paper/index']) ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Actions   <i class="fa fa-cog fa-spin fa-1x fa-fw"></i> </div>
           
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Accounts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?=url::to(['/studyRepo/admin/users']) ?>">view Accounts</a>
                                <a class="nav-link" href="<?=url::to(['/studyRepo/admin/register']); ?>">Add User</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-reader"></i></div>
                            Papers
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                          
                                <a class="nav-link " href="<?=url::to(['/studyRepo/paper/index']) ?>" >
                                    view Papers

                                </a>

                                <a class="nav-link " href="<?=url::to(['/studyRepo/paper/create']) ?>"">
                                    Add paper

                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">

                                </div>
                         
                        </div>
                        <a class="nav-link" href="<?=url::to(['/studyRepo/home/index']); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-home"> </i></div>
                           
                            Edit home page
                        </a>
                        <a class="nav-link" href="<?=url::to(['/studyRepo/admin/register']); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                            Add admin
                        </a>
                        
                        <?php  if(!yii::$app->user->getIsGuest()) { ?>
                        <a class="nav-link" href="<?= Url::to(['/studyRepo/admin/logout']) ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-slash"></i></div>
                            logout
                        </a>
                        <?php }    ?>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small"><a class="text-decoration-none" href="<?= url::to(['/site/index']) ?>" >view site</a></div>

                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
       
          <main role="main">
                            <div class="container">
                            <?php
$successmessage = Yii::$app->session->getFlash('success');
if ($successmessage) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $successmessage;
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
}
?>

                                <?= $content ?>
                            </div>
                        </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>







    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
