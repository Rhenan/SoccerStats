<?php
    include 'includeAjax.php';
    include "../../model/class.model.admin.php";
    
    $modelAdmin = new modelAdmin();
    
    $deletarCamp = $modelAdmin->delete("DELETE FROM tb_campeonato WHERE id = ?", array($_POST['delete']));
    
    if ($deletarCamp) {$lang->t('Campeonato Deletado');echo '!';}
    if ($deletarCamp) {
?>
        <script>
            $("#camp<?php echo $_POST['delete'];?>").delay(1000).fadeOut("slow", function () {
                $("#camp<?php echo $_POST['delete'];?>").remove();
            });
        </script>
<?php
    }
?>