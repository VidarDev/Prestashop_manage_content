<!-- Custom content -->
<div class="itrmanagecontent-custom-content">
    {if isset($customer.avatar)}<img src="{$urls.base_url}modules/itrmanagecontent/views/img/avatars/{$customer.avatar}" alt="{$customer.firstname} avatar" />{/if}
    <h2 class="display-1 itrmanagecontent-custom-content--title">{l s='Bonjour' mod='itrmanagecontent'} {$customer.firstname}</h2>
    <p>{$texteConnecte|escape:'html':'UTF-8'}</p>
</div>