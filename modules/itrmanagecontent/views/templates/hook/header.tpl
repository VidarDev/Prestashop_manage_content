<!-- Banner Front Admin Group -->
<div class="alert alert-info itrmanagecontent-banner" role="alert" style="position: fixed; top: 0; width: 100%; z-index: 9999;">
    <div class="container itrmanagecontent-banner__container">
        <span>{l s='Produits actifs' mod='itrmanagecontent'} : {$totalActiveProducts}</span>
        <a href="{$link->getProductLink($mostOrderedProductId)}">{l s='Produit le plus commandé' mod='itrmanagecontent'}</a>
        <span>{l s='Prix moyen du panier' mod='itrmanagecontent'} : {$averageCartValue} {$currencySign}</span>
    </div>
</div>
