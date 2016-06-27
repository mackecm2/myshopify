function validate(){
var allok = true;
  if(frmAddProduct.Product_Name.value == ""){
    alert('Please enter a Product Name');
    return false;
  }
  if(isNaN(frmAddProduct.SKU.value)){
    alert('Invalid input for SKU (Stock Keeping Unit), this must be a number')
    return false;
  }
  if(isNaN(frmAddProduct.Price.value)){
    alert('Invalid input for Price, this must be a number')
    return false;
  }
  if(isNaN(frmAddProduct.Shipping_Weight.value)){
    alert('Invalid input for Shipping Weight, this must be a number')
    return false;
  }
document.frmAddProduct.Submit.disabled="disabled";
return true;
}