
<div class="categorias-container"></div>

<h1>Lista de Categorias</h1>
<?php
if (count($data) == 0) {
    echo "<p style='text-align: center'>Nenhuma categoria cadastrada.</p>";
}
foreach($data as $categoria){
?>
    <div class="card-categorias">
        <?= $categoria->descricao ?>
        <img onclick="deletar(<?= $categoria->id ?>)" src="https://icons.veryicon.com/png/o/construction-tools/coca-design/delete-189.png" />
    </div>
<?php
}
?>
<form id="form-deletar" method="POST" action="./acoes.php">
    <input type="hidden" name="acao" value="deletar" />
    <input type="hidden" id="categoriaId" name="categoriaId" value="" />
</form>
</div>

<script>

    function deletarCategoria(categoriaId){
        if(confirm("Deseja realmente deletar esta categoria?"))
            window.location = `/categorias/destroy/${categoriaId}`;
    }
</script>