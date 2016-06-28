<?

	session_start();

	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;

	require __DIR__.'/conf.php';

	$shopify = shopify\client(SHOPIFY_SHOP, SHOPIFY_APP_API_KEY, SHOPIFY_APP_PASSWORD, true);

	try
	{
		# Making an API request can throw an exception
		$product = $shopify('POST /admin/products.json', array(), array
		(
			'product' => array
			(
				"title" => $_POST['Product_Name'] ,
				"body_html" => "<strong>".$_POST['Description']."</strong>",
				"vendor" => "URG Trial",
				"variants" => array
				(
					array
					(
						"price" => $_POST['Price'],
						"sku" => $_POST['SKU'],
                                                "weight" => $_POST['Shipping_Weight'],
                                                "weight_unit" => "lb"
					)
				),
				"images" => array
				(
                                        "attachment" => preg_replace('#^data:image/\w+;base64,#i', '', $_POST['ImageFileName']."==\n")
				),
			)
		));

		print_r($product['title']." has been successfully added. Click <a href=index.html>here</a> to add another product.");
	}
	catch (shopify\ApiException $e)
	{
		# HTTP status code was >= 400 or response contained the key 'errors'
		echo $e;
		print_R($e->getRequest());
		print_R($e->getResponse());
	}
	catch (shopify\CurlException $e)
	{
		# cURL error
		echo $e;
		print_R($e->getRequest());
		print_R($e->getResponse());
	}

?>