<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID Produit</th>
      <th>Nom du Produit</th>
      <th>Texte du Signalement</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    {foreach from=$errors item=error}
      <tr>
        <td>{$error.id_product}</td>
        <td>{$error.product_name}</td>
        <td>{$error.report_text}</td>
        <td>{$error.date_add}</td>
      </tr>
    {/foreach}
  </tbody>
</table>
