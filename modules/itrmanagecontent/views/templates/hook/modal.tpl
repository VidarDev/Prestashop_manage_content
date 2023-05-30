<!-- Button trigger modal -->
<div class="itrmanagecontent-report-form">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#errorReportModal" data-product-id="{$product.id_product}">
    {l s='Signaler une erreur' mod='itrmanagecontent'}
  </button>
</div>

<!-- Modal -->
<div class="modal fade in" id="errorReportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title h6 text-sm-center" id="myModalLabel">{l s='Signaler une erreur' mod='itrmanagecontent'}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">close</i></span>
        </button>
      </div>
      <div class="modal-body">
        <form id="errorReportForm">
          <input type="hidden" id="product_id" value="{$product.id_product}">
          <input type="hidden" id="product_name" value="{$product.name}">
          <div class="form-group">
            <label for="message-text" class="col-form-label">{l s='Message' mod='itrmanagecontent'} :</label>
           <textarea class="form-control" id="reportText"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="submit-button" class="btn btn-primary">{l s='Envoyer' mod='itrmanagecontent'}</button>
      </div>
    </div>
  </div>
</div>
