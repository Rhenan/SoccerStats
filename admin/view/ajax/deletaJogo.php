<?php
    include 'includeAjax.php';
    include "../../model/class.model.admin.php";
    
    $modelAdmin = new modelAdmin();
    
    $deletarJogo = $modelAdmin->delete("DELETE FROM tb_jogos WHERE id = ?", array($_POST['delete']));
    $deletarGols = $modelAdmin->delete("DELETE FROM tb_gols WHERE id_jogo = ?", array($_POST['delete']));
    
    if ($deletarJogo) {$lang->t('Jogo Deletado');echo '! | ';}
    if ($deletarGols) {$lang->t('Gols Deletados');echo '!';}
    if ($deletarJogo && $deletarGols) {
?>
        <script>
            $("#jogo<?php echo $_POST['delete'];?>").delay(1000).fadeOut("slow", function () {
                $("#jogo<?php echo $_POST['delete'];?>").remove();
            });
        </script>
<?php
    }
?>