<?php
    include 'includeAjax.php';
    include "../../model/class.model.admin.php";
    
    $modelAdmin = new modelAdmin();
    
    $deletarCamp = $modelAdmin->delete("DELETE FROM tb_times WHERE id = ?", array($_POST['delete']));
    
    if ($deletarCamp) {$lang->t('Time Deletado');echo '!';}
    if ($deletarCamp) {
?>
        <script>
            $("#time<?php echo $_POST['delete'];?>").delay(1000).fadeOut("slow", function () {
                $("#time<?php echo $_POST['delete'];?>").remove();
            });
        </script>
<?php
    }
?>