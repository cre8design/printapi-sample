# Print Api Sample
Example code for creating and managing orders. 
Login at to see your orders https://shop.printingambitions.com/customer/account/login/

## Product Naming Scheme
Products are named as followed. 
``` 
{{product_identifier}}-{{width}}-{{height}}-{{mounting_system_identifier}}-{{attribute-1}}...
```
e.g. pl4-20-30-map

#### Product Identifiers
Identifier | Name
----- | ------
plg  	| Plexiglas 4mm
cvs2  	| Canvas 2cm
cvs4  	| Canvas 4cm
dbw  	| Dibond Wit
rvs 	| Dibond BF
frx3  	| Forex 3mm
frx5  	| Forex 5mm
frx10  	| Forex 10mm
fbh  	| Fotobehang
gls4  	| Glas 4mm
hout 	| Hout 10 mm
mgnt 	| Magnet
rup 	| Roll Up
stk	 	| Sticker Wit
tp 		| Tuin Poster
poster 	| Poster
diff	| Anders

#### Mounting system Identifiers
Identifier | Name
----- | ------
none 	| No Mountingsystem
mbk 	| Blind Kunststoff
mfotw 	| Flat on the Wall
map 	| Aluminiumprofil``
msp 	| Spandraad
mbs 	| Bureausteun
mamg 	| Afstandhouders met gaten
msh 	| Spinhaken
mtp 	| Tesa Powerstrips
framed 	| Ingelijst/Passe Partout (Black)
framedw 	| Ingelijst/Passe Partout (White)

## Authorization
Authorize the request by adding your Bearer Token to the  header. 
``` 
Authorization: Bearer {{TOKEN}} 
```



## Get Product List
#### URL
``` [GET] https://shop.printingambitions.com/rest/V1/print/product/list/:page ```
- :page = Page Number
#### PARAMS
- ```?product_filter={{product}}``` Filter by product name
#### RESULT
```javascript
{
    "total_count": 4,
    "page": 1,
    "page_size": 20,
    "items": [
        {
            "product": "pl4-20-40-map",      // Product Identifier
            "price": 8.88,                   // Price
            "width": 20,                     // Height in cm
            "height": 40,                    // Width in cm
            "mounting_system": "map",        // Mounting system identifier
            "resolution": 150,               // Required resolution in ppi
            "bleed": 0.3,                    // Required Bleed
            "white_bleed": 0,                // Required White Wleed
            "mimetype": ".jpg",              // Required Mimetype (not implemented yet)
            "color_profile": "adobergb.icc", // Required Color profile
            "flip": true                     // Flip flag
        },
        ...
    ]
}
```


## Get Product
#### URL
``` [GET] https://shop.printingambitions.com/rest/V1/print/product/get/:product ```
- ```:product``` = Product Identifier
#### RESULT
```javascript
{
    "product": "pl4-20-40-map",      // Product Identifier
    "price": 8.88,                   // Price
    "width": 20,                     // Height in cm
    "height": 40,                    // Width in cm
    "mounting_system": "map",        // Mounting system identifier
    "resolution": 150,               // Required resolution in ppi
    "bleed": 0.3,                    // Required Bleed
    "white_bleed": 0,                // Required White Wleed
    "mimetype": ".jpg",              // Required Mimetype (not implemented yet)
    "color_profile": "adobergb.icc", // Required Color profile
    "flip": true                     // Flip flag
}
```



## Get Order List
#### URL
``` [GET] https://shop.printingambitions.com/rest/V1/print/order/list/:page ```
- ```:page``` = Page Number
#### PARAMS
- ```?reference={{reference}}``` Filter by reference
#### RESULT
```javascript
{
    "total_count": 4,       // Total count of all Orders
    "page": 1,              // Current Page
    "page_size": 20,        // Current Page Size
    "items": [
        {
            "order_id": 2000000988,                         // Order ID
            "order_reference": "reference 123",             // Order reference (optional)   
            "order_message": "Lorem ipsum dolor sit amet",  // Order message (optional)
            "status": "processing",                         // Order status
            "currency": "EUR",                              // Currency
            "subtotal": 94.99,                              // Subtotal
            "shipping_amount": 4.99,                        // Shipping Cost
            "grand_total": 99.98,                           // Grand total
            "created_at": "2019-03-15 09:57:32",            // Date of creation
            "shipping_address": {                           // Shipping Address Data
                "firstname": "John",
                "lastname": "Doe",
                "company": "Example Company Co.",
                "country_id": "NL",
                "postcode": "AD1234",
                "city": "Gronau",
                "street": "Maybachstraße 4",
                "telephone": "01578798708",
                "email": "john@doe.com"
            },
            "items": [                                      // Array of Order items
                {
                    "id": 1234,                             // Order Item ID
                    "product": "pl4-20-30-map",             // Product Identifier
                    "qty": 12,                              // Quantity Ordererd
                    "price": 18.88                          // Price
                    "layout": {                             // Layout data
                        "width": 20,                        // Expected Width in cm
                        "height": 30,                       // Expected Height in cm
                        "bleed": 0.3,                       // Expected Bleed
                        "white_bleed": 0,                   // Expected White bleed
                        "resolution": 150,                  // Expected PPI
                        "mimetype": ".jpg",                 // Suggested Mimetype (works with pdf and tiff as well)
                        "colorspace": "adobergb.icc",       // Expected Colorspace
                        "flip": 0,                          // Expected Flip Flag| 0 = none; 1 = flip | 2 = flop
                        "generated": 0,                     // Wether a file has been generated
                        "print_file_url": "http://sample-website.com/print/file/1234.pdf", // Url to print file
                        "items": []                         // Layout Item Composite (not implemented yet)
                    }
                }
            ]
        },
        ...
    ]
}
```



## Get Order
#### URL
``` [GET] https://shop.printingambitions.com/rest/V1/print/order/list/:order_id ```
- ```:order_id``` = Order ID
#### RESULT
```javascript
{
    "order_id": 2000000988,                         // Order ID
    "order_reference": "reference 123",             // Order reference (optional)   
    "order_message": "Lorem ipsum dolor sit amet",  // Order message (optional)
    "status": "processing",                         // Order status
    "currency": "EUR",                              // Currency
    "subtotal": 94.99,                              // Subtotal
    "shipping_amount": 4.99,                        // Shipping Cost
    "grand_total": 99.98,                           // Grand total
    "created_at": "2019-03-15 09:57:32",            // Date of creation
    "shipping_address": {                           // Shipping Address Data
        "firstname": "John",
        "lastname": "Doe",
        "company": "Example Company Co.",
        "country_id": "NL",
        "postcode": "AD1234",
        "city": "Gronau",
        "street": "Maybachstraße 4",
        "telephone": "01578798708",
        "email": "john@doe.com"
    },
    "items": [                                      // Array of Order items
        {
            "id": 1234,                             // Order Item ID
            "product": "pl4-20-30-map",             // Product Identifier
            "qty": 12,                              // Quantity Ordererd
            "price": 18.88                          // Price
            "layout": {                             // Layout data
                "width": 20,                        // Expected Width in cm
                "height": 30,                       // Expected Height in cm
                "bleed": 0.3,                       // Expected Bleed
                "white_bleed": 0,                   // Expected White bleed
                "resolution": 150,                  // Expected PPI
                "mimetype": ".jpg",                 // Suggested Mimetype (works with pdf and tiff as well)
                "colorspace": "adobergb.icc",       // Expected Colorspace
                "flip": 0,                          // Expected Flip Flag| 0 = none; 1 = flip | 2 = flop
                "generated": 0,                     // Wether a file has been generated
                "print_file_url": "http://sample-website.com/print/file/1234.pdf", // Url to print file
                "items": []                         // Layout Item Composite (not implemented yet)
            }
        }
    ]
}
```



## Create Order
#### URL
``` [POST] https://shop.printingambitions.com/rest/V1/print/order/create ```
#### REQUEST
```javascript
{
    "order_request": {
        "order_reference": "some-reference",                // Optional order reference
        "order_message": "Lorem ipsum dolor sit amet",      // Optional order message
        "shipping_address": {                               // Shipping Address Data
            "firstname": "John",
            "lastname": "Doe",
            "company": "Example Company Co.",               // Optional
            "country_id": "NL",
            "postcode": "AD1234",
            "city": "Gronau",
            "street": "Maybachstraße 4",
            "telephone": "01578798708",
            "email": "john@doe.com"
        },
        "items": [                                          // Array of order items
            {
                "product": "pl4-20-30-map",                 // Product Identifier
                "qty": 12,                                  // Quantity to order
                "layout": {                                 // Layout data
                    "print_file_url": "http://sample-website.com/print/file/1234.pdf" // URL to print fiile
                }
            },
            ...
        ]
    }
}
```
#### RESULT
```javascript
{
    "order_id": 2000000988,                         // Order ID
    "order_reference": "reference 123",             // Order reference (optional)   
    "order_message": "Lorem ipsum dolor sit amet",  // Order message (optional)
    "status": "processing",                         // Order status
    "currency": "EUR",                              // Currency
    "subtotal": 94.99,                              // Subtotal
    "shipping_amount": 4.99,                        // Shipping Cost
    "grand_total": 99.98,                           // Grand total
    "created_at": "2019-03-15 09:57:32",            // Date of creation
    "shipping_address": {                           // Shipping Address Data
        "firstname": "John",
        "lastname": "Doe",
        "company": "Example Company Co.",
        "country_id": "NL",
        "postcode": "AD1234",
        "city": "Gronau",
        "street": "Maybachstraße 4",
        "telephone": "01578798708",
        "email": "john@doe.com"
    },
    "items": [                                      // Array of Order items
        {
            "id": 1234,                             // Order Item ID
            "product": "pl4-20-30-map",             // Product Identifier
            "qty": 12,                              // Quantity Ordererd
            "price": 18.88                          // Price
            "layout": {                             // Layout data
                "width": 20,                        // Expected Width in cm
                "height": 30,                       // Expected Height in cm
                "bleed": 0.3,                       // Expected Bleed
                "white_bleed": 0,                   // Expected White bleed
                "resolution": 150,                  // Expected PPI
                "mimetype": ".jpg",                 // Suggested Mimetype (works with pdf and tiff as well)
                "colorspace": "adobergb.icc",       // Expected Colorspace
                "flip": 0,                          // Expected Flip Flag| 0 = none; 1 = flip | 2 = flop
                "generated": 0,                     // Wether a file has been generated
                "print_file_url": "http://sample-website.com/print/file/1234.pdf", // Url to print file
                "items": []                         // Layout Item Composite (not implemented yet)
            }
        }
    ]
}
```



## Error Handling
In case of an error the API returns an error message.
#### Result
```javascript
{
    "message": "{{Error message}}" // String with error message
}
```