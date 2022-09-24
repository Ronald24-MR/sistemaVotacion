    <?php  session_start();
   if(!isset($_SESSION['rol'])){
        header("location: ../../index.php");
   }
   else{
        if($_SESSION['rol'] != 1){
            header("location: ../../index.php");
        }
   } ?>
            <?php include("menu.php"); ?>
            

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Welcome</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Welcome Administrador <?php  ?></li>
                        </ol>
                        
                    </div>
                </main>
               
            </div>
        </div>

