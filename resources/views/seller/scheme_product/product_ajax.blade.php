<option value="">Select Sub category</option>
<?PHP foreach($productList as $vs): ?>
<option value="<?=$vs->id?>"><?=$vs->name?></option>
<?PHP endforeach; ?>