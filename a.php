FORMAT: 1A

# honestbee

This is the Honest Bee API for client devices.

#### Conventions
- access_token: placed on the url parameter to make it explicit on which APIs require the access token.

# Group Account

## Login [POST /api/account/token]
Authenticate a given user

In order to use the client API, a user access token must be passed.  A user access token needs to be requested with the current user’s credentials, the client id/secret, and the scope that is requested for the access token.

** Honest Bee client id:**
b96d9397a36d0bcb45ee97b3ad99cfb8576dc55280ad0202809d209ba6bb4f00

** Honest Bee client secret:**
90c0409eb849f82a34190c785b95743dd44b0d52432d224d630fbdcaa158d971

Example call with curl:

    curl -i https://xxxxxxxxx.com/api/account/token -F grant_type=password -F client_id=b96d9397a36d0bcb45ee97b3ad99cfb8576dc55280ad0202809d209ba6bb4f00 -F client_secret=90c0409eb849f82a34190c785b95743dd44b0d52432d224d630fbdcaa158d971 -F username=user@example.com -Fpassword=your_password_here

+ Request 200 (application/json)

    + Attributes
        + grant_type: password (string) - Required, authentication method. Should be 'password'
        + client_id: b96d9397a36d0bcb45ee97b3ad99cfb8576dc55280ad0202809d209ba6bb4f00 (string) - Required. Client id for the application
        + client_secret: 90c0409eb849f82a34190c785b95743dd44b0d52432d224d630fbdcaa158d971 (string) ) - Required. Client secret for the application
        + username: grace@honestbee.com (string) - Required. Username, usually an email
        + password: password (string) ) - Required. User's password
        + guest_cart_token: thisIsAnOptionalGuestCartToken (string) - Optional. Only necessary if there is a cart token in the guest session to be merged to the user's cart token. Can also be null.

+ Response 200 (application/json; charset=utf-8)

        {
            "access_token": "9f66a3cb6a52bfd64886672c329adcef79d515886ea8d3a27f5f393ae3c902ef",
            "token_type": "bearer",
            "expires_in": 31104000,
            "refresh_token": "787560fd187010ef3116a417cfa7709443dd8c2866a97643f8f8b5e899e7e16d",
            "scope": "public",
            "created_at": 1463999688,
            "user": {
                "id": 1,
                "email": "chris@honestbee.com",
                "name": "Chris Wang",
                "mobileNumber": "44444444",
                "imageUrl": "https://lifeopp.blob.core.windows.net/entity/243731_141015090457_192.jpg",
                "type": "",
                "surname": "Wang",
                "givenName": "Chris",
                "defaultPostalCode": null,
                "defaultAddress": null,
                "currentCartToken": "f552f7bd-7c01-46ec-a9ec-5fade5918e26",
                "firebaseEndpoint": "https://intense-fire-5364.firebaseio.com/carts/f552f7bd-7c01-46ec-a9ec-5fade5918e26",
                "hasFirstPurchaseCoupon": false,
                "defaultBrand": null,
                "defaultZone": null
            },
            "firebaseCustomToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE0NjQwODYwODgsInYiOjAsImlhdCI6MTQ2Mzk5OTY4OCwiZCI6eyJ1aWQiOiJmNTUyZjdiZC03YzAxLTQ2ZWMtYTllYy01ZmFkZTU5MThlMjYiLCJjYXJ0X3Rva2VuIjoiZjU1MmY3YmQtN2MwMS00NmVjLWE5ZWMtNWZhZGU1OTE4ZTI2Iiwicm9sZXMiOiIiLCJ1c2VyX2lkIjoxfX0.MqIUxn1gsVa52X0iYRbFmEeiey-wePyi3NrFoJIgeQg",
            "firebaseCustomTokenExpires": 1464086088,
            "assetHost": "honestbees-test.s3.amazonaws.com",
            "assetImagePath": "products/images"
        }

## Logout [POST /api/account/revoke]
This revokes the access token.  Similar to logging out.

Example call with curl:

    curl -i https://xxxxxxxxx.com/api/account/revoke -F access_token=cb0bbc44676ae44c7c96bf3e6e7449fb826e9342184dac745b3f61ebd37c46ae -F token=cb0bbc44676ae44c7c96bf3e6e7449fb826e9342184dac745b3f61ebd37c46ae


+ Request 200 (application/json)

    + Body

            {
              "access_token" : "cb0bbc44676ae44c7c96bf3e6e7449fb826e9342184dac745b3f61ebd37c46ae",
              "token" : "cb0bbc44676ae44c7c96bf3e6e7449fb826e9342184dac745b3f61ebd37c46ae"
            }


    + Schema

            {
                "type": "object",
                "properties": {
                    "access_token": {
                        "type": "string",
                        "required": true
                    },
                    "token": {
                        "type": "string",
                        "required": true
                    }
                }
            }


+ Response 200 (application/json; charset=utf-8)

        {
        }

# Group User

## User SignUp [/api/me/sign_up]

### Create a new user [POST]
In the past: If didn't pass in the postal code, will return 400 (Missing Parameters), if pass in postal code, but it doesn't exist in our database, will return 404 (Not Found)
Now: we allow to create a new user without postal code.

+ Request 200 (application/json)

    + Body

            {
                "user":
                {
                    "email": "grace+150506@lifeopp.io",
                    "password": "newpassword",
                    "name":"Grace Zhang",
                    "surname": "Zhang",
                    "givenName":"Grace",
                    "defaultPostalCode":"029998",
                    "currentCartToken":"4cdf32b8-c8ad-4d30-9e2a-84f30525a7c8",
                    "agreement":true
                }
            }

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "user": {
                    "id": 32,
                    "email": "grace+150506@lifeopp.io",
                    "name": "Grace Zhang",
                    "surname": "Zhang",
                    "givenName": "Grace",
                    "mobileNumber": null,
                    "defaultPostalCode": "",
                    "currentCartToken": "4cdf32b8-c8ad-4d30-9e2a-84f30525a7c8",
                    "firebaseEndpoint": "https://honestbee-develop.firebaseio.com/users/4cdf32b8-c8ad-4d30-9e2a-84f30525a7c8",
                    "hasFirstPurchaseCoupon": true,
                    "defaultBrand": {
                        "id": 2,
                        "name": "Cold Storage",
                        "slug": "cold-storage",
                        "description": null,
                        "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/images/cold-storage.png"
                    },
                    "defaultZone": {
                        "id": 1,
                        "name": "CBD"
                    }
                },
                "access_token": "46055a6ef99319d4d72a73d3d550fff75678583ed274fd1f633d55c8189b9438",
                "assetHost": "honestbees-testing.s3.amazonaws.com",
                "assetImagePath": "products/images"
            }

## User Context [/api/me?access_token={access_token}]

### Get user context [GET]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token which is returned from the api/account/login.

+ Response 200 (application/json; charset=utf-8)

        {
            "assetHost": "honestbees-test.s3.amazonaws.com",
            "assetImagePath": "products/images",
            "user": {
                "id": 1,
                "email": "chris@honestbee.com",
                "name": "Chris Wang",
                "mobileNumber": "44444444",
                "imageUrl": "https://lifeopp.blob.core.windows.net/entity/243731_141015090457_192.jpg",
                "type": "",
                "surname": "Wang",
                "givenName": "Chris",
                "defaultPostalCode": null,
                "defaultAddress": null,
                "currentCartToken": "f552f7bd-7c01-46ec-a9ec-5fade5918e26",
                "firebaseEndpoint": "https://intense-fire-5364.firebaseio.com/carts/f552f7bd-7c01-46ec-a9ec-5fade5918e26",
                "hasFirstPurchaseCoupon": false,
                "defaultBrand": null,
                "defaultZone": null
            },
            "firebaseCustomToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE0NjQwODYwOTQsInYiOjAsImlhdCI6MTQ2Mzk5OTY5NCwiZCI6eyJ1aWQiOiJmNTUyZjdiZC03YzAxLTQ2ZWMtYTllYy01ZmFkZTU5MThlMjYiLCJjYXJ0X3Rva2VuIjoiZjU1MmY3YmQtN2MwMS00NmVjLWE5ZWMtNWZhZGU1OTE4ZTI2Iiwicm9sZXMiOiIiLCJ1c2VyX2lkIjoxfX0.c63mKFcqAsx8v6Q1T04Kdf7ayi7XGb1IJDXiZo5VRbU",
            "firebaseCustomTokenExpires": 1464086094,
            "status": {
                "message": "Ok",
                "code": 10000
            }
        }

## User S3 Policy [/api/me/s3_policy?access_token={access_token}]

### Get user s3_policy [GET]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token which is returned from the api/account/login.

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
              "s3PostUrl": "https://honestbees-development.s3.amazonaws.com/",
              "postFormTemplate": {
                "ACL": "public-read",
                "Policy": "eyJleHBpcmF0aW9uIjoiMjAxNS0wNy0xOFQwMDo1NjoyOFoiLCJjb25kaXRpb25zIjpbeyJidWNrZXQiOiJob25lc3RiZWVzLWRldmVsb3BtZW50In0sWyJzdGFydHMtd2l0aCIsIiRrZXkiLCJzZy9iZWVzLzEvaW1hZ2VzIl0seyJhY2wiOiJwdWJsaWMtcmVhZCJ9LFsic3RhcnRzLXdpdGgiLCIkQ2FjaGUtQ29udHJvbCIsIiJdLFsic3RhcnRzLXdpdGgiLCIkQ29udGVudC1UeXBlIiwiIl0sWyJjb250ZW50LWxlbmd0aC1yYW5nZSIsMCwxMDQ4NTc2MF1dfQ==",
                "Signature": "0BnOxbBJFKseiMIl3qn6PtQFADc=",
                "Cache-Control": "",
                "Content-Type": "",
                "AwsAccessKeyId": "THEAWSACCESSKEYID"
              },
              "decodedPolicy": {
                "expiration": "2015-07-18T00:56:28Z",
                "conditions": [
                  {
                    "bucket": "honestbees-development"
                  },
                  [
                    "starts-with",
                    "$key",
                    "sg/bees/1/images"
                  ],
                  {
                    "acl": "public-read"
                  },
                  [
                    "starts-with",
                    "$Cache-Control",
                    ""
                  ],
                  [
                    "starts-with",
                    "$Content-Type",
                    ""
                  ],
                  [
                    "content-length-range",
                    0,
                    10485760
                  ]
                ]
              }
            }

## Update User Basic info [/api/me/update?access_token={access_token}]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token

### Update User Contact info [PATCH]

+ Request 200 (application/json)

    + Body

            {
                "user":
                {

                    "surname": "Zhang",
                    "givenName": "Grace",
                    "mobileNumber": "456789"
                }
            }

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "status": {
                    "code" : 200,
                    "message": "User info was updated successfully"
                }
            }

## User update password [/api/me/update_password?access_token={access_token}]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token

### Update password [PATCH]

+ Request 200 (application/json)

    + Body

            {
                "user":
                    {
                        "password": "password1",
                        "password_confirmation": "password1",
                        "current_password": "newpassword"
                    }
            }

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "status": {
                    "code" : 200,
                    "message": "User update password successfully"
                }
            }

## Update User shopper info [/api/me/postal_code?access_token={access_token}]
When user change the postal code, will update the postal code, zone id and brand id

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token

### Update user shopper info [PATCH]
+ Request 200 (application/json)

    + Body

            {
                "postal_code" : "029998"
            }

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "brand": {
                    "id": 6,
                    "name": "Sheng Siong",
                    "slug": "sheng-siong",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/images/sheng-siong.png",
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0"
                },
                "zone": {
                    "id": 1,
                    "name": "Sector-01"
                }
            }

## Get delivery zone [/api/me/delivery_zone?countryCode={countryCode}&latitude={latitude}&longiture={longitude}&postalCode={postalCode}]

+ Parameters
    + countryCode (required, string, `SG`) ... Country Code
    + latitude (required, string, `1.3`) ... Latitude
    + longitude (required, string, `1.3`) ... Longitude
    + postalCode (required, string, `029998`) ... Postal Code, required for Singapore only

### Get delivery zone [GET]
+ Response 200 (application/json; charset=utf-8)

        {
            "id": 1,
            "name": "Sector-01"
        }

## User Forgot password [/api/me/forgot_password]

### Forget password [POST]

+ Request 200 (application/json)

    + Body

            {
                "emailAddress" : "grace@honestbee.com"
            }

+ Response 200 (application/json; charset=utf-8)

        {
            "ok": true
        }

## Reset Password Token [/api/me/check_token_valid]

### Is reset password token valid or not [POST]

+ Request 200 (application/json)

    + Body

            {
                "reset_password_token": "justASampleResetPasswordToken"
            }

+ Response 200 (application/json; charset=utf-8)

        {
            "user": {
                "id": 1,
                "email": "chris@honestbee.com",
                "name": "Chris Wang",
                "mobileNumber": "44444444",
                "imageUrl": "https://lifeopp.blob.core.windows.net/entity/243731_141015090457_192.jpg",
                "type": "",
                "surname": "Wang",
                "givenName": "Chris",
                "defaultPostalCode": null,
                "defaultAddress": null,
                "currentCartToken": "f552f7bd-7c01-46ec-a9ec-5fade5918e26",
                "firebaseEndpoint": "https://intense-fire-5364.firebaseio.com/carts/f552f7bd-7c01-46ec-a9ec-5fade5918e26",
                "hasFirstPurchaseCoupon": false,
                "defaultBrand": null,
                "defaultZone": null
            },
            "status": {
                "message": "Ok",
                "code": 10000
            }
        }

## User Reset Password [/api/me/reset_password]

### Reset Password [POST]

+ Request 200 (application/json)

    + Body

            {
                "resetPasswordToken": "justASampleResetPasswordToken",
                "password": "newpassword"
            }

+ Response 200 (application/json; charset=utf-8)

            {
                "status": {
                    "code" : 200,
                    "message": "Password reset successfully"
                }
            }

## User Confirm Email [/api/me/confirm_email]

### Confirm Email [POST]

+ Request 200 (application/json)

    + Body

            {
                "confirmation_token": "zzBLsF1m2nMb7ySyx3Vc"
            }

+ Response 200 (application/json; charset=utf-8)

            {
                "status": {
                    "code" : 200,
                    "message": "Email confirmed successfully"
                }
            }

# Group Zone
Zones are used to track where postal codes belong and which stores can be ordered from in a given postal code.

## Zones [/api/zones]

### Get zone list [GET]
+ Response 200 (application/json; charset=utf-8)
    + Body

            [
                {
                    "id" : 100000,
                    "name" : "test zone",
                    "stores" : [{
                        "id" : 1,
                        "name" : "Redmart",
                        "slug" : null,
                        "brandId" : 1,
                        "addressId" : null,
                        "catalogId" : 1,
                        "priority" : null,
                        "notes" : null,
                        "description" : "store",
                        "imageUrl" : null
                    }, {
                        "id" : 4,
                        "name" : "Isetan",
                        "slug" : null,
                        "brandId" : 4,
                        "addressId" : null,
                        "catalogId" : 4,
                        "priority" : null,
                        "notes" : null,
                        "description" : "store",
                        "imageUrl" : null
                    }]
                },
                {
                    "id" : 100001,
                    "name" : "test zone 2",
                    "stores" : []
                }
            ]

## Zone for Post Code [/api/zones/{postalCode}]
Notes: Getting zone for the given postal code, so the id is postal code, not zone id

+ Parameters
    + postalCode (required, string, `029998`) ... The postal code

### Get zone for by the given post code [GET]
+ Response 200 (application/json; charset=utf-8)
    + Body

            {
                "id" : 1,
                "name" : "Sector-01"
            }

## Zone Information v2 [/api/zones/{id}]
API for all delivery related information about a zone

+ Parameters
    + id (required, string, `1`) ... Zone id

### Zone Information v2 [GET]

+ Request 200
    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

        {
            "id": 1,
            "name": "Sector-01",
            "brands": [
                {
                    "id": 2,
                    "name": "Cold Storage",
                    "slug": "cold-storage",
                    "description": null,
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/cold-storage.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "defaultConciergeFee": null,
                    "departments": [
                        {
                            "id": 1,
                            "name": "Fruits & Vegetables",
                            "description": null,
                            "imageUrl": "/fruits-vegetables.jpg"
                        },
                        {
                            "id": 2,
                            "name": "Meats & Seafood",
                            "description": null,
                            "imageUrl": "/meats-seafood.jpg"
                        },
                        {
                            "id": 3,
                            "name": "Dairy, Eggs & Deli",
                            "description": null,
                            "imageUrl": "/dairy-eggs-deli.jpg"
                        },
                        {
                            "id": 4,
                            "name": "Wellness & Organics",
                            "description": null,
                            "imageUrl": "/wellness-organics.jpg"
                        },
                        {
                            "id": 5,
                            "name": "Rice & Noodles",
                            "description": null,
                            "imageUrl": "/rice-noodles.jpg"
                        },
                        {
                            "id": 6,
                            "name": "Frozen Foods",
                            "description": null,
                            "imageUrl": "/frozen-foods.jpg"
                        },
                        {
                            "id": 7,
                            "name": "Beverages",
                            "description": null,
                            "imageUrl": "/beverages.jpg"
                        },
                        {
                            "id": 8,
                            "name": "Snacks & Sweets",
                            "description": null,
                            "imageUrl": "/snacks-sweets.jpg"
                        },
                        {
                            "id": 9,
                            "name": "Bakery & Breakfast Items",
                            "description": null,
                            "imageUrl": "/bakery-breakfast-items.jpg"
                        },
                        {
                            "id": 10,
                            "name": "Baking Needs",
                            "description": null,
                            "imageUrl": "/baking-needs.jpg"
                        },
                        {
                            "id": 11,
                            "name": "Pantry",
                            "description": null,
                            "imageUrl": "/pantry.jpg"
                        },
                        {
                            "id": 12,
                            "name": "Oils, Salt & Sugar",
                            "description": null,
                            "imageUrl": "/oils-salt-sugar.jpg"
                        },
                        {
                            "id": 13,
                            "name": "Beers, Wine & Spirits",
                            "description": null,
                            "imageUrl": "/beers-wine-spirits.jpg"
                        },
                        {
                            "id": 14,
                            "name": "Household Products",
                            "description": null,
                            "imageUrl": "/household-products.jpg"
                        },
                        {
                            "id": 15,
                            "name": "Baby Care",
                            "description": null,
                            "imageUrl": "/baby-care.jpg"
                        },
                        {
                            "id": 16,
                            "name": "Pets",
                            "description": null,
                            "imageUrl": "/pets.jpg"
                        },
                        {
                            "id": 17,
                            "name": "Personal Care",
                            "description": null,
                            "imageUrl": "/personal-care.jpg"
                        }
                    ],
                    "brandTraits": [],
                    "storeId": 2
                },
                {
                    "id": 6,
                    "name": "Sheng Siong",
                    "slug": "sheng-siong",
                    "description": "",
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/sheng-siong.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "defaultConciergeFee": null,
                    "departments": [],
                    "brandTraits": [],
                    "storeId": 6
                },
                {
                    "id": 8,
                    "name": "The Butcher's Dog",
                    "slug": "the-butchers-dog",
                    "description": "",
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/the-butchers-dog.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "defaultConciergeFee": null,
                    "departments": [],
                    "brandTraits": [],
                    "storeId": 8
                }
            ],
            "hubs": []
        }

# Group Brand
A brand represents a brand or chain of stores.  For example: Cold Storage, Fair Price.

## Brand [/api/brands/{id}]

+ Parameters
    + id (required, number, `2`) ... Brand id

### Retrieve a Brand  [GET]
+ Response 200 (application/json; charset=utf-8)
    + Body

            {
                "id": 2,
                "name": "Cold Storage",
                "slug": "cold-storage",
                "description": null,
                "about": null,
                "imageUrl": "cold-storage.png",
                "brandColor": "000000",
                "minimumOrderFreeDelivery": "80.0",
                "defaultDeliveryFee": "10.0",
                "parentBrandId": null
            }

## Brands Collection [/api/brands]
The whole list of brands. We may remove this in the future.

### List of Brand [GET]
+ Response 200 (application/json; charset=utf-8)
    + Body

            [
                {
                    "id": 2,
                    "name": "Cold Storage",
                    "slug": "cold-storage",
                    "description": null,
                    "about": null,
                    "imageUrl": null,
                    "brandColor": "000000",
                    "productsImageUrl": null,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "parentBrandId": null,
                    "departments": [
                        {
                            "id": 626,
                            "name": "Babies",
                            "description": null,
                            "imageUrl": null
                        },
                        {
                            "id": 625,
                            "name": "Beers, Wine & Spirits",
                            "description": null,
                            "imageUrl": null
                        }
                    ]
                },
                {
                    "id": 3,
                    "name": "Fair Price",
                    "slug": "fair-price",
                    "description": null,
                    "about": null,
                    "imageUrl": null,
                    "brandColor": "000000",
                    "productsImageUrl": null,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "parentBrandId": null,
                    "departments": [
                        {
                            "id": 626,
                            "name": "Babies",
                            "description": null,
                            "imageUrl": null
                        },
                        {
                            "id": 625,
                            "name": "Beers, Wine & Spirits",
                            "description": null,
                            "imageUrl": null
                        }
                    ]
                },
                {
                    "id": 4,
                    "name": "MEIDI YA",
                    "slug": "meidi",
                    "description": "",
                    "imageUrl": null,
                    "brandColor": "000000",
                    "productsImageUrl": null,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "parentBrandId": null,
                    "departments": []
                },
                {
                    "id": 1,
                    "name": "Sheng Siong",
                    "slug": "sheng-siong",
                    "description": "",
                    "imageUrl": null,
                    "brandColor": "000000",
                    "productsImageUrl": null,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "parentBrandId": null,
                    "departments": []
                }
            ]

## Brands Collection for Zone [/api/zones/{zoneId}/brands]
This is the brand list for the given zone id

+ Parameters
    + zoneId (required, integer, `1`) ... The zone id.

### List of Brands for Zone [GET]
+ Response 200 (application/json; charset=utf-8)
    + Body

            [
                {
                    "id" : 2,
                    "name" : "Cold Storage",
                    "slug" : null,
                    "description" : null,
                    "about": null,
                    "imageUrl": null,
                    "brandColor": "000000",
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "parentBrandId": null
                },
                {
                    "id" : 3,
                    "name" : "Fair Price",
                    "slug" : null,
                    "description" : null,
                    "about": null,
                    "imageUrl": null,
                    "brandColor": "000000",
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "parentBrandId": null
                }
            ]

## Brands Collection v2 [/api/brands?productsLimit={productsLimit}&productsSort={productsSort}&page={page}&pageSize={pageSize}]
The whole list of brands. We may remove this in the future.

+ Parameters
    + productsLimit (optional, string, `6`) ... number of products returned for each brand
    + productsSort (optional, string, `price:asc`) ... sort of products, default to `popularity`, others: `price:asc`, `price:desc`
    + page (optional, number, `1`) ... brands pagination
    + pageSize (optional, number, `10`) ... brands pagination page size

### List of Brand v2 [GET]
+ Request 200
    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

        {
            "brands": [
                {
                    "id": 2,
                    "name": "Cold Storage",
                    "slug": "cold-storage",
                    "description": null,
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/cold-storage.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 78,
                    "storeId": 2,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": [
                        {
                            "id": 3957,
                            "title": "Essential Pure Drinking Water",
                            "description": null,
                            "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_128526_784db723fec251796491ce443a47994f.jpg",
                            "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_128526_784db723fec251796491ce443a47994f.jpg",
                            "slug": "essential-pure-drinking-water",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": "550 ml",
                            "status": "status_available",
                            "imageUrlBasename": "1_128526_784db723fec251796491ce443a47994f.jpg",
                            "currency": "SGD",
                            "price": "0.45",
                            "normalPrice": "0.45"
                        },
                        {
                            "id": 3987,
                            "title": "Ice Berg Mineral Water",
                            "description": null,
                            "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_106756_2985a54a35d68cf9e4d54fe7fc2f6d07.jpg",
                            "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_106756_2985a54a35d68cf9e4d54fe7fc2f6d07.jpg",
                            "slug": "ice-berg-mineral-water",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": "600 ml",
                            "status": "status_available",
                            "imageUrlBasename": "1_106756_2985a54a35d68cf9e4d54fe7fc2f6d07.jpg",
                            "currency": "SGD",
                            "price": "0.45",
                            "normalPrice": "0.45"
                        },
                        {
                            "id": 4000,
                            "title": "POLAR Natural Mineral Water",
                            "description": null,
                            "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_120403_5e282dbd16491d87b2596ce5aefd9661.jpg",
                            "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_120403_5e282dbd16491d87b2596ce5aefd9661.jpg",
                            "slug": "polar-natural-mineral-water",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": "600ML",
                            "status": "status_available",
                            "imageUrlBasename": "1_120403_5e282dbd16491d87b2596ce5aefd9661.jpg",
                            "currency": "SGD",
                            "price": "0.5",
                            "normalPrice": "0.5"
                        },
                        {
                            "id": 3219,
                            "title": "Pagoda Fine Salt",
                            "description": null,
                            "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_728014_da80459cd04e6c5d329adcb39d507582.jpg",
                            "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_728014_da80459cd04e6c5d329adcb39d507582.jpg",
                            "slug": "pagoda-fine-salt",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": "500 g",
                            "status": "status_available",
                            "imageUrlBasename": "1_728014_da80459cd04e6c5d329adcb39d507582.jpg",
                            "currency": "SGD",
                            "price": "0.55",
                            "normalPrice": "0.55"
                        },
                        {
                            "id": 3953,
                            "title": "Dasani Drinking Water",
                            "description": null,
                            "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_34096_a7d657b001f314c4a178ce273e198e5a.jpg",
                            "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_34096_a7d657b001f314c4a178ce273e198e5a.jpg",
                            "slug": "dasani-drinking-water",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": "600 ml",
                            "status": "status_available",
                            "imageUrlBasename": "1_34096_a7d657b001f314c4a178ce273e198e5a.jpg",
                            "currency": "SGD",
                            "price": "0.55",
                            "normalPrice": "0.55"
                        },
                        {
                            "id": 3984,
                            "title": "Ice Mountain Pure Drinking Water",
                            "description": null,
                            "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_135087_e30691e697d3109c5cf28be8c8d5eefb.jpg",
                            "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_135087_e30691e697d3109c5cf28be8c8d5eefb.jpg",
                            "slug": "ice-mountain-pure-drinking-water",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": "600 ml",
                            "status": "status_available",
                            "imageUrlBasename": "1_135087_e30691e697d3109c5cf28be8c8d5eefb.jpg",
                            "currency": "SGD",
                            "price": "0.55",
                            "normalPrice": "0.55"
                        }
                    ]
                },
                {
                    "id": 3,
                    "name": "Fair Price",
                    "slug": "fair-price",
                    "description": null,
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/fair-price.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 78,
                    "storeId": 3,
                    "minimumOrderFreeDelivery": "8.0",
                    "defaultDeliveryFee": "1.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": [
                        {
                            "id": 21075,
                            "title": "Fairprice Plain Flour 1KG",
                            "description": null,
                            "imageUrl": null,
                            "previewImageUrl": null,
                            "slug": "fairprice-plain-flour-1kg",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": null,
                            "status": "status_available",
                            "imageUrlBasename": null,
                            "currency": "SGD",
                            "price": "1.85",
                            "normalPrice": null
                        },
                        {
                            "id": 24178,
                            "title": "Budget Floor Cleaner 3LT",
                            "description": null,
                            "imageUrl": null,
                            "previewImageUrl": null,
                            "slug": "budget-floor-cleaner-3lt",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": null,
                            "status": "status_available",
                            "imageUrlBasename": null,
                            "currency": "SGD",
                            "price": "3.8",
                            "normalPrice": null
                        }
                    ]
                },
                {
                    "id": 4,
                    "name": "Isetan",
                    "slug": "isetan",
                    "description": null,
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/isetan.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 0,
                    "storeId": 4,
                    "minimumOrderFreeDelivery": "8.0",
                    "defaultDeliveryFee": "1.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": []
                },
                {
                    "id": 5,
                    "name": "Meidi-Ya",
                    "slug": "meidi-ya",
                    "description": "",
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/meidi-ya.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 0,
                    "storeId": 5,
                    "minimumOrderFreeDelivery": "8.0",
                    "defaultDeliveryFee": "1.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": []
                },
                {
                    "id": 6,
                    "name": "Sheng Siong",
                    "slug": "sheng-siong",
                    "description": "",
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/sheng-siong.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 0,
                    "storeId": 6,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": []
                },
                {
                    "id": 7,
                    "name": "Huber's Butchery",
                    "slug": "hubers-butchery",
                    "description": "",
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/hubers-butchery.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 0,
                    "storeId": 7,
                    "minimumOrderFreeDelivery": "8.0",
                    "defaultDeliveryFee": "1.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": []
                },
                {
                    "id": 8,
                    "name": "The Butcher's Dog",
                    "slug": "the-butchers-dog",
                    "description": "",
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/the-butchers-dog.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 0,
                    "storeId": 8,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": []
                },
                {
                    "id": 9,
                    "name": "Four Seasons Organic Market",
                    "slug": "four-seasons-organic-market",
                    "description": "",
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/four-seasons-organic-market.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 0,
                    "storeId": 9,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": []
                }
            ],
            "meta": {
                "current_page": 1,
                "total_pages": 1,
                "total_count": 8
             }
        }

## Brands Collection for Zone v2 [/api/zones/{zoneId}/brands?productsLimit={productsLimit}&productsSort={productsSort}&page={page}&pageSize={pageSize}]
This is the brand list for the given zone id

+ Parameters
    + zoneId (required, integer, `1`) ... The zone id.
    + productsLimit (optional, string, `6`) ... number of products returned for each brand
    + productsSort (optional, string, `price:asc`) ... sort of products, default to `popularity`, others: `price:asc`, `price:desc`
    + page (optional, number, `1`) ... brands pagination
    + pageSize (optional, number, `10`) ... brands pagination page size

### List of Brand v2 [GET]
+ Request 200
    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

        {
            "brands": [
                {
                    "id": 2,
                    "name": "Cold Storage",
                    "slug": "cold-storage",
                    "description": null,
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/cold-storage.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 78,
                    "storeId": 2,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": [
                        {
                            "id": 3957,
                            "title": "Essential Pure Drinking Water",
                            "description": null,
                            "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_128526_784db723fec251796491ce443a47994f.jpg",
                            "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_128526_784db723fec251796491ce443a47994f.jpg",
                            "slug": "essential-pure-drinking-water",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": "550 ml",
                            "status": "status_available",
                            "imageUrlBasename": "1_128526_784db723fec251796491ce443a47994f.jpg",
                            "currency": "SGD",
                            "price": "0.45",
                            "normalPrice": "0.45"
                        },
                        {
                            "id": 3987,
                            "title": "Ice Berg Mineral Water",
                            "description": null,
                            "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_106756_2985a54a35d68cf9e4d54fe7fc2f6d07.jpg",
                            "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_106756_2985a54a35d68cf9e4d54fe7fc2f6d07.jpg",
                            "slug": "ice-berg-mineral-water",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": "600 ml",
                            "status": "status_available",
                            "imageUrlBasename": "1_106756_2985a54a35d68cf9e4d54fe7fc2f6d07.jpg",
                            "currency": "SGD",
                            "price": "0.45",
                            "normalPrice": "0.45"
                        },
                        {
                            "id": 4000,
                            "title": "POLAR Natural Mineral Water",
                            "description": null,
                            "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_120403_5e282dbd16491d87b2596ce5aefd9661.jpg",
                            "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_120403_5e282dbd16491d87b2596ce5aefd9661.jpg",
                            "slug": "polar-natural-mineral-water",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": "600ML",
                            "status": "status_available",
                            "imageUrlBasename": "1_120403_5e282dbd16491d87b2596ce5aefd9661.jpg",
                            "currency": "SGD",
                            "price": "0.5",
                            "normalPrice": "0.5"
                        },
                        {
                            "id": 3219,
                            "title": "Pagoda Fine Salt",
                            "description": null,
                            "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_728014_da80459cd04e6c5d329adcb39d507582.jpg",
                            "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_728014_da80459cd04e6c5d329adcb39d507582.jpg",
                            "slug": "pagoda-fine-salt",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": "500 g",
                            "status": "status_available",
                            "imageUrlBasename": "1_728014_da80459cd04e6c5d329adcb39d507582.jpg",
                            "currency": "SGD",
                            "price": "0.55",
                            "normalPrice": "0.55"
                        },
                        {
                            "id": 3953,
                            "title": "Dasani Drinking Water",
                            "description": null,
                            "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_34096_a7d657b001f314c4a178ce273e198e5a.jpg",
                            "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_34096_a7d657b001f314c4a178ce273e198e5a.jpg",
                            "slug": "dasani-drinking-water",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": "600 ml",
                            "status": "status_available",
                            "imageUrlBasename": "1_34096_a7d657b001f314c4a178ce273e198e5a.jpg",
                            "currency": "SGD",
                            "price": "0.55",
                            "normalPrice": "0.55"
                        },
                        {
                            "id": 3984,
                            "title": "Ice Mountain Pure Drinking Water",
                            "description": null,
                            "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_135087_e30691e697d3109c5cf28be8c8d5eefb.jpg",
                            "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_135087_e30691e697d3109c5cf28be8c8d5eefb.jpg",
                            "slug": "ice-mountain-pure-drinking-water",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": "600 ml",
                            "status": "status_available",
                            "imageUrlBasename": "1_135087_e30691e697d3109c5cf28be8c8d5eefb.jpg",
                            "currency": "SGD",
                            "price": "0.55",
                            "normalPrice": "0.55"
                        }
                    ]
                },
                {
                    "id": 3,
                    "name": "Fair Price",
                    "slug": "fair-price",
                    "description": null,
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/fair-price.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 78,
                    "storeId": 3,
                    "minimumOrderFreeDelivery": "8.0",
                    "defaultDeliveryFee": "1.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": [
                        {
                            "id": 21075,
                            "title": "Fairprice Plain Flour 1KG",
                            "description": null,
                            "imageUrl": null,
                            "previewImageUrl": null,
                            "slug": "fairprice-plain-flour-1kg",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": null,
                            "status": "status_available",
                            "imageUrlBasename": null,
                            "currency": "SGD",
                            "price": "1.85",
                            "normalPrice": null
                        },
                        {
                            "id": 24178,
                            "title": "Budget Floor Cleaner 3LT",
                            "description": null,
                            "imageUrl": null,
                            "previewImageUrl": null,
                            "slug": "budget-floor-cleaner-3lt",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "size": null,
                            "status": "status_available",
                            "imageUrlBasename": null,
                            "currency": "SGD",
                            "price": "3.8",
                            "normalPrice": null
                        }
                    ]
                },
                {
                    "id": 4,
                    "name": "Isetan",
                    "slug": "isetan",
                    "description": null,
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/isetan.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 0,
                    "storeId": 4,
                    "minimumOrderFreeDelivery": "8.0",
                    "defaultDeliveryFee": "1.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": []
                },
                {
                    "id": 5,
                    "name": "Meidi-Ya",
                    "slug": "meidi-ya",
                    "description": "",
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/meidi-ya.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 0,
                    "storeId": 5,
                    "minimumOrderFreeDelivery": "8.0",
                    "defaultDeliveryFee": "1.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": []
                },
                {
                    "id": 6,
                    "name": "Sheng Siong",
                    "slug": "sheng-siong",
                    "description": "",
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/sheng-siong.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 0,
                    "storeId": 6,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": []
                },
                {
                    "id": 7,
                    "name": "Huber's Butchery",
                    "slug": "hubers-butchery",
                    "description": "",
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/hubers-butchery.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 0,
                    "storeId": 7,
                    "minimumOrderFreeDelivery": "8.0",
                    "defaultDeliveryFee": "1.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": []
                },
                {
                    "id": 8,
                    "name": "The Butcher's Dog",
                    "slug": "the-butchers-dog",
                    "description": "",
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/the-butchers-dog.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 0,
                    "storeId": 8,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": []
                },
                {
                    "id": 9,
                    "name": "Four Seasons Organic Market",
                    "slug": "four-seasons-organic-market",
                    "description": "",
                    "about": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/four-seasons-organic-market.jpg",
                    "productsImageUrl": null,
                    "brandColor": null,
                    "currency": "SGD",
                    "sameStorePrice": true,
                    "brandType": "regular",
                    "promotionText": null,
                    "parentBrandId": null,
                    "productsCount": 0,
                    "storeId": 9,
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0",
                    "defaultConciergeFee": null,
                    "brandTraits": [],
                    "products": []
                }
            ],
            "meta": {
                "current_page": 1,
                "total_pages": 1,
                "total_count": 8
             }
        }

## Brand Products and Search v2 [/api/brands/{brandSlug}/products?q={q}&zoneId={zoneId}&categoryIds%5B%5D={categoryIds}&departmentIds%5B%5D={departmentIds}&fields%5B%5D={fields}&sort={sort}&page={page}&pageSize={pageSize}&aggLimit={aggLimit}]
API for listing products for search results page

+ Parameters
    + q (optional, string, `lotus`) ... The search text
    + zoneId (optional, number, `1`) ... The zone id, if zone does not match with store, will return 404
    + fields (optional, array, `categories`) ... if set, the categories won’t have pagination due to the nature of aggregation, default limit to 100 results, e.g. `categories`, `departments`
    + aggLimit (optional, number, `50`) ... override aggregation limit of 100
    + categoryIds (optional, array, ``) ... Category filter to filter results for certain categories
    + departmentIds (optional, array, `2`) ... Department filter to filter results for certain departments
    + sort (optional, string, `price:asc`) ... Sorting method, default to `relevance` if `q` is present, default to `popularity` if `q` is not present, others: `price:asc`, `price:desc`, `popularity`
    + page (optional, number, `1`) ... Current page of results, default to `1`
    + pageSize (optional, number, `10`) ... Number of items for each page of results, default to `48`

### Brand Products and search v2 [GET]

+ Request 200

    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

        {
            "products": [],
            "meta": {
                "current_page": 1,
                "total_pages": 0,
                "total_count": 0
            },
            "categories": [
                {
                    "id": 76,
                    "title": "Biscuits",
                    "slug": "8-biscuits",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 3
                },
                {
                    "id": 56,
                    "title": "Breads",
                    "slug": "6-breads",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 1
                },
                {
                    "id": 120,
                    "title": "Tissues & Wipes",
                    "slug": "14-tissues-wipes",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 1
                }
            ]
        }

# Group Store
A store represents a physical store that has an address.  A store belongs to a brand.

## Stores Collection [/api/stores?fields={fields}]

+ Parameters
    + fields (optional, string, `brand`) ... Whether to show the brand or not.

### List of Stores [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 1,
                    "name": "Redmart",
                    "slug": "Redmart",
                    "brandId": 1,
                    "addressId": null,
                    "catalogId": 1,
                    "priority": null,
                    "notes": null,
                    "description": null,
                    "imageUrl": null,
                    "brand": {
                        "id": 1,
                        "name": "Sheng Siong",
                        "slug": "sheng-siong",
                        "description": "",
                        "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/images/sheng-siong.png",
                        "minimumOrderFreeDelivery": "80.0",
                        "defaultDeliveryFee": "10.0"
                    }
                },
                {
                    "id": 2,
                    "name": "Cold Storage",
                    "slug": "Cold Storage",
                    "brandId": 2,
                    "addressId": null,
                    "catalogId": 2,
                    "priority": null,
                    "notes": null,
                    "description": null,
                    "imageUrl": null,
                    "brand": {
                        "id": 2,
                        "name": "Cold Storage",
                        "slug": "cold-storage",
                        "description": null,
                        "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/images/cold-storage.png",
                        "minimumOrderFreeDelivery": "80.0",
                        "defaultDeliveryFee": "10.0"
                    }
                },
                {
                    "id": 3,
                    "name": "Fair Price",
                    "slug": "Fair Price",
                    "brandId": 3,
                    "addressId": null,
                    "catalogId": 3,
                    "priority": null,
                    "notes": null,
                    "description": null,
                    "imageUrl": null,
                    "brand": {
                        "id": 3,
                        "name": "Fair Price",
                        "slug": "fair-price",
                        "description": null,
                        "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/images/fair-price.png",
                        "minimumOrderFreeDelivery": "80.0",
                        "defaultDeliveryFee": "10.0"
                    }
                },
                {
                    "id": 4,
                    "name": "Isetan",
                    "slug": "Isetan",
                    "brandId": 4,
                    "addressId": null,
                    "catalogId": 4,
                    "priority": null,
                    "notes": null,
                    "description": null,
                    "imageUrl": null,
                    "brand": {
                        "id": 4,
                        "name": "MEIDI YA",
                        "slug": "meidi",
                        "description": "",
                        "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/images/meidi.png",
                        "minimumOrderFreeDelivery": "80.0",
                        "defaultDeliveryFee": "10.0"
                    }
                }
            ]

## Stores Collection for brand [/api/brands/{brandId}/stores?fields={fields}]

+ Parameters
    + brandId (required, integer, `2`) ... The brand id.
    + fields (optional, string, `brand`) ... Whether to show the brand or not.

### List of Stores [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 1,
                    "name": "Redmart",
                    "slug": "Redmart",
                    "brandId": 1,
                    "addressId": null,
                    "catalogId": 1,
                    "priority": null,
                    "notes": null,
                    "description": null,
                    "imageUrl": null,
                    "brand": {
                        "id": 1,
                        "name": "Redmart",
                        "slug": "redmart",
                        "description": "",
                        "imageUrl": null,
                        "minimumOrderFreeDelivery": "80.0",
                        "defaultDeliveryFee": "10.0"
                    }
                }
            ]

## Stores Collection for zone [/api/zones/{zoneId}/stores?fields={fields}]
This is going to get the list of stores for the given zone id. If pass in "fields=brands" then is going to return the list with brand, otherwise won't return with brand.

+ Parameters
    + zoneId (required, integer, `2`) ... The zone id.
    + fields (optional, string, `brand`) ... Whether to show the brand or not.

### List of Stores [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id" : 2,
                    "name" : "Cold Storage",
                    "slug" : null,
                    "brandId" : 2,
                    "addressId" : null,
                    "catalogId" : 2,
                    "priority" : null,
                    "notes" : null,
                    "description" : "store",
                    "imageUrl" : null,
                    "brand" : {
                        "id" : 2,
                        "name" : "Cold Storage",
                        "slug" : null,
                        "description" : "Cold Storage",
                        "imageUrl" : null,
                        "minimumOrderFreeDelivery": "80.0",
                        "defaultDeliveryFee": "10.0"
                    }
                }, {
                    "id" : 3,
                    "name" : "Fair Price",
                    "slug" : null,
                    "brandId" : 3,
                    "addressId" : null,
                    "catalogId" : 3,
                    "priority" : null,
                    "notes" : null,
                    "description" : "store",
                    "imageUrl" : null,
                    "brand" : {
                        "id" : 3,
                        "name" : "Fair Price",
                        "slug" : null,
                        "description" : "Fair Price",
                        "imageUrl" : null,
                        "minimumOrderFreeDelivery": "80.0",
                        "defaultDeliveryFee": "10.0"
                    }
                }
            ]

## Stores Collection for zone and brand [/api/zones/{zoneId}/brands/{brandId}/stores?fields={fields}]

+ Parameters
    + zoneId (required, integer, `100000`) ... The zone id.
    + brandId (required, integer, `1`) ... The brand id.
    + fields (optional, string, `brand`) ... Whether to show the brand or not.

### List of Stores [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id" : 2,
                    "name" : "Cold Storage",
                    "slug" : null,
                    "brandId" : 2,
                    "addressId" : null,
                    "catalogId" : 2,
                    "priority" : null,
                    "notes" : null,
                    "description" : "store",
                    "imageUrl" : null,
                    "brand": {
                        "id": 2,
                        "name": "Cold Storage",
                        "slug": "cold-storage",
                        "description": null,
                        "imageUrl": null,
                        "minimumOrderFreeDelivery": "80.0",
                        "defaultDeliveryFee": "10.0"
                    }
                },
                {
                    "id" : 3,
                    "name" : "Fair Price",
                    "slug" : null,
                    "brandId" : 3,
                    "addressId" : null,
                    "catalogId" : 3,
                    "priority" : null,
                    "notes" : null,
                    "description" : "store",
                    "imageUrl" : null,
                    "brand": {
                        "id": 3,
                        "name": "Fair Price",
                        "slug": "fair-price",
                        "description": null,
                        "imageUrl": null,
                        "minimumOrderFreeDelivery": "80.0",
                        "defaultDeliveryFee": "10.0"
                    }
                }
            ]

## Store [/api/zones/{zoneId}/brands/{brandSlug}/store?fields={fields}]

+ Parameters
    + zoneId (required, integer, `1`) ... The zone id.
    + brandSlug (required, string, `cold-storage`) ... The brand slug.
    + fields (optional, string, `brand`) ... Whether to show the brand or not.

### Retrieve a Store [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "id": 2,
                "name": "Cold Storage",
                "slug": "cold-storage",
                "brandId": 2,
                "addressId": 3,
                "catalogId": 2,
                "priority": null,
                "notes": null,
                "description": null,
                "imageUrl": "cold-storage.png",
                "brand": {
                    "id": 2,
                    "name": "Cold Storage",
                    "slug": "cold-storage",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/cold-storage.jpg",
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0"
                }
            }

## Store [/api/stores/{id}?fields={fields}]
If don't pass in the fields, won't show brand.

+ Parameters
    + id (required, integer, `2`) ... The store id.
    + fields (optional, string, `brand`) ... Whether to show the brand or not.

### Retrieve a Store [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "id": 2,
                "name": "Cold Storage",
                "slug": "cold-storage",
                "brandId": 2,
                "addressId": 2,
                "catalogId": 2,
                "priority": null,
                "notes": null,
                "description": null,
                "imageUrl": "cold-storage.png",
                "brand": {
                    "id": 2,
                    "name": "Cold Storage",
                    "slug": "cold-storage",
                    "description": null,
                    "imageUrl": "cold-storage.png",
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0"
                }
            }

## User Ordered Products v2 [/api/stores/{id}/ordered_products?accessToken={accessToken}&limit={limit}]
API for listing products which user previously ordered

+ Parameters
    + id (required, string, `2`) ... store id
    + accessToken (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... users access token
    + limit (optional, number, `50`) ... override max results limit of 100

### User Ordered Products v2 [GET]

+ Request 200

    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

        [
            {
                "id": 21,
                "title": "Prepacked Starfruit (Malaysia)",
                "description": null,
                "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_79245_968169839ec0fa228966a376fa846fc1.jpg",
                "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_79245_968169839ec0fa228966a376fa846fc1.jpg",
                "slug": "prepacked-starfruit-malaysia",
                "barcode": null,
                "unitType": "unit_type_item",
                "soldBy": "sold_by_item",
                "amountPerUnit": "1.0",
                "size": "500 g",
                "status": "status_available",
                "imageUrlBasename": "1_79245_968169839ec0fa228966a376fa846fc1.jpg",
                "currency": "SGD",
                "price": "2.5",
                "normalPrice": "2.5"
            },
            {
                "id": 22,
                "title": "Red Watermelon (Malaysia)",
                "description": "One cup of diced watermelon is 46 kcal.",
                "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_36315_d00034aae4cbf8c661ac04d24d372b8b.jpg",
                "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_36315_d00034aae4cbf8c661ac04d24d372b8b.jpg",
                "slug": "red-watermelon-malaysia",
                "barcode": null,
                "unitType": "unit_type_item",
                "soldBy": "sold_by_item",
                "amountPerUnit": "1.0",
                "size": "~3.5 kg",
                "status": "status_available",
                "imageUrlBasename": "1_36315_d00034aae4cbf8c661ac04d24d372b8b.jpg",
                "currency": "SGD",
                "price": "7.15",
                "normalPrice": "7.15"
            },
            {
                "id": 23,
                "title": "Yellow Watermelon (Malaysia)",
                "description": "One cup of diced watermelon is 46 kcal.",
                "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_110092_ecee4fbc7e95219db243edf9952f174f.jpg",
                "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_110092_ecee4fbc7e95219db243edf9952f174f.jpg",
                "slug": "yellow-watermelon-malaysia",
                "barcode": null,
                "unitType": "unit_type_item",
                "soldBy": "sold_by_item",
                "amountPerUnit": "1.0",
                "size": "3.5 kg",
                "status": "status_available",
                "imageUrlBasename": "1_110092_ecee4fbc7e95219db243edf9952f174f.jpg",
                "currency": "SGD",
                "price": "6.15",
                "normalPrice": "6.15"
            },
            {
                "id": 24,
                "title": "Coconut Top Off, Thailand",
                "description": null,
                "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_90770_085daa085084f2823c7b98bddff9d591.jpg",
                "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_90770_085daa085084f2823c7b98bddff9d591.jpg",
                "slug": "coconut-top-off-thailand",
                "barcode": null,
                "unitType": "unit_type_item",
                "soldBy": "sold_by_item",
                "amountPerUnit": "1.0",
                "size": "200 g",
                "status": "status_available",
                "imageUrlBasename": "1_90770_085daa085084f2823c7b98bddff9d591.jpg",
                "currency": "SGD",
                "price": "4.05",
                "normalPrice": "4.05"
            },
            {
                "id": 25,
                "title": "Fragrant Pear Packet (China)",
                "description": "An average pear (per 100g) is 58 kcal.",
                "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_73669_ffde15bc3a66cf58ab22b9281f515c5c.jpg",
                "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_73669_ffde15bc3a66cf58ab22b9281f515c5c.jpg",
                "slug": "fragrant-pear-packet-china",
                "barcode": null,
                "unitType": "unit_type_item",
                "soldBy": "sold_by_item",
                "amountPerUnit": "1.0",
                "size": "6/pack",
                "status": "status_available",
                "imageUrlBasename": "1_73669_ffde15bc3a66cf58ab22b9281f515c5c.jpg",
                "currency": "SGD",
                "price": "6.15",
                "normalPrice": "6.15"
            },
            {
                "id": 26,
                "title": "Packham Pear (Australia)",
                "description": null,
                "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_79035_04a5f6ca0d227ce23e60226ef80daae1.jpg",
                "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_79035_04a5f6ca0d227ce23e60226ef80daae1.jpg",
                "slug": "packham-pear-australia",
                "barcode": null,
                "unitType": "unit_type_item",
                "soldBy": "sold_by_item",
                "amountPerUnit": "1.0",
                "size": "250 g",
                "status": "status_available",
                "imageUrlBasename": "1_79035_04a5f6ca0d227ce23e60226ef80daae1.jpg",
                "currency": "SGD",
                "price": "1.5",
                "normalPrice": "1.5"
            },
            {
                "id": 28,
                "title": "Organic Dried Wild Blueberry",
                "description": null,
                "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_28958_7f05d9fcfaad20011f3049a4a8a92c39.jpg",
                "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_28958_7f05d9fcfaad20011f3049a4a8a92c39.jpg",
                "slug": "organic-dried-wild-blueberry",
                "barcode": null,
                "unitType": "unit_type_item",
                "soldBy": "sold_by_item",
                "amountPerUnit": "1.0",
                "size": "12 oz",
                "status": "status_available",
                "imageUrlBasename": "1_28958_7f05d9fcfaad20011f3049a4a8a92c39.jpg",
                "currency": "SGD",
                "price": "29.8",
                "normalPrice": "29.8"
            },
            {
                "id": 29,
                "title": "Raspberries (USA)",
                "description": "Vitamin K in raspberries helps wound healing and supports blood clot formation.",
                "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_107002_a5161b522db085cb2046c4aeba1da589.jpg",
                "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_107002_a5161b522db085cb2046c4aeba1da589.jpg",
                "slug": "raspberries-usa",
                "barcode": null,
                "unitType": "unit_type_item",
                "soldBy": "sold_by_item",
                "amountPerUnit": "1.0",
                "size": "170 g",
                "status": "status_available",
                "imageUrlBasename": "1_107002_a5161b522db085cb2046c4aeba1da589.jpg",
                "currency": "SGD",
                "price": "11.3",
                "normalPrice": "11.3"
            },
            {
                "id": 30,
                "title": "Strawberries With Stem (USA)",
                "description": "A single serving of strawberries (per 100g) is 33 kcal.",
                "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_13448_1d30011a25ab30b71c2fcbc2f630c94e.jpg",
                "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_13448_1d30011a25ab30b71c2fcbc2f630c94e.jpg",
                "slug": "strawberries-with-stem-usa",
                "barcode": null,
                "unitType": "unit_type_item",
                "soldBy": "sold_by_item",
                "amountPerUnit": "1.0",
                "size": "454 g",
                "status": "status_available",
                "imageUrlBasename": "1_13448_1d30011a25ab30b71c2fcbc2f630c94e.jpg",
                "currency": "SGD",
                "price": "24.65",
                "normalPrice": "24.65"
            },
            {
                "id": 31,
                "title": "Driscoll's Strawberries with Stem (USA)",
                "description": null,
                "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_137167_ebf965d6d70735d5cfd4498932f22d9e.jpg",
                "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_137167_ebf965d6d70735d5cfd4498932f22d9e.jpg",
                "slug": "driscoll-s-strawberries-with-stem-usa",
                "barcode": null,
                "unitType": "unit_type_item",
                "soldBy": "sold_by_item",
                "amountPerUnit": "1.0",
                "size": "4 each",
                "status": "status_available",
                "imageUrlBasename": "1_137167_ebf965d6d70735d5cfd4498932f22d9e.jpg",
                "currency": "SGD",
                "price": "64.25",
                "normalPrice": "64.25"
            }
        ]


## Deals Products v2 [/api/stores/{id}/deals?categoryIds%5B%5D={categoryIds}&fields%5B%5D={fields}&sort={sort}&page={page}&pageSize={pageSize}&aggLimit={aggLimit}]
API for listing products with deals

+ Parameters
    + id (required, string `2`) ... Store id
    + fields (optional, array, `categories`) ... if set, the categories won’t have pagination due to the nature of aggregation, default limit to 100 results
    + aggLimit (optional, number, `50`) ... override aggregation limit of 100
    + categoryIds (optional, array, `2`) ... Category filter to filter results for certain categories
    + sort (optional, string, `price:asc`) ... Sorting method, default to `relevance`, others: `price`, `price:desc`
    + page (optional, number, `1`) ... Current page of results, default to `1`
    + pageSize (optional, number, `10`) ... Number of items for each page of results, default to `48`

### Deals Products v2 [GET]

+ Request 200
    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

        {
            "products": [
                {
                    "id": 3421,
                    "title": "Nissin Cup Noodles, Chicken",
                    "description": null,
                    "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_677071_d352c6d1dbe6f495bef18a6963c37d22.jpg",
                    "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_677071_d352c6d1dbe6f495bef18a6963c37d22.jpg",
                    "slug": "nissin-cup-noodles-chicken",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "size": "75 g",
                    "status": "status_available",
                    "imageUrlBasename": "1_677071_d352c6d1dbe6f495bef18a6963c37d22.jpg",
                    "currency": "SGD",
                    "price": "1.5",
                    "normalPrice": "1.5",
                    "jsonData": "{\"size\":\"75 g\",\"unit\":\"item\",\"brand\":\"Nissin\",\"productname\":\"Cup Noodles, Chicken\",\"product_unit_quantity\":{},\"json_halal\":false,\"json_kosher\":false,\"halal\":false,\"kosher\":false}",
                    "condition": "condition_none"
                }
            ],
            "categories": [
                {
                    "id": 50,
                    "title": "Instant Noodles",
                    "slug": "5-instant-noodles",
                    "imageUrl": null,
                    "description": null,
                    "departmentId": 5,
                    "departmentName": "Rice & Noodles",
                    "productsCount": 42
                }
            ],
            "meta": {
                "current_page": 2,
                "total_pages": 22,
                "total_count": 44
            }
        }

## Store Directory v2 [/api/stores/{id}/directory?zoneId={zoneId}]
API for listing departments and categories within a store

+ Parameters
    + id (required, string, `2`) ... Store id
    + zoneId (required, number, `1`) ... Zone id

### Store Directory v2 [GET]

+ Request 200
    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

        {
            "departments": [
                {
                    "id": 20,
                    "name": "A.B.S. Pantry Staples",
                    "description": null,
                    "imageUrl": "/a-b-s-pantry-staples.jpg",
                    "productsCount": 16,
                    "categories": [
                        {
                            "id": 150,
                            "title": "A.B.S. Pantry Staples",
                            "slug": "20-a-b-s-pantry-staples",
                            "imageUrl": null,
                            "productsCount": 16
                        }
                    ]
                }
            ],
            "childStores": [
                {
                    "id": 9,
                    "name": "Four Seasons Organic Market",
                    "pickupPoint": null,
                    "slug": "four-seasons-organic-market",
                    "brandId": 9,
                    "addressId": null,
                    "catalogId": 9,
                    "priority": null,
                    "notes": "",
                    "description": "",
                    "imageUrl": null,
                    "storeType": "regular",
                    "brand": {
                        "id": 9,
                        "name": "Four Seasons Organic Market",
                        "slug": "four-seasons-organic-market",
                        "description": "",
                        "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/four-seasons-organic-market.jpg",
                        "productsImageUrl": "",
                        "brandColor": "",
                        "currency": "SGD",
                        "sameStorePrice": true,
                        "promotionText": "",
                        "childBrand": true,
                        "minimumOrderFreeDelivery": "80.0",
                        "defaultDeliveryFee": "10.0",
                        "defaultConciergeFee": null
                    },
                    "brandTraits": [
                        {
                            "slug": "cny",
                            "name": "Chinese New Year",
                            "header": "Celebrating Chinese New Year"
                        }
                    ]
                }
            ]
        }

## Store Delivery Timeslots v2 [/api/stores/{id}/delivery_timeslots?days={days}]
API for get store timeslots for partner

+ Parameters
    + id (required, string, `2`) ... Store id
    + accessToken (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... users access token
    + days (required, number, `2`) ... Query days

### Store Delivery Timeslots v2 [GET]

+ Request 200

    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

        {
            "days": [
                {
                    "day": "2016-11-07T00:00:00.000+08:00",
                    "times": [
                        {
                            "id": 450,
                            "status": "not_available",
                            "startDate": "2016-11-07T11:00:00.000+08:00"
                        },
                        {
                            "id": 451,
                            "status": "not_available",
                            "startDate": "2016-11-07T12:00:00.000+08:00"
                        },
                        {
                            "id": 452,
                            "status": "available",
                            "startDate": "2016-11-07T13:00:00.000+08:00"
                        }
                    ]
                },
                {
                    "day": "2016-11-08T00:00:00.000+08:00",
                    "times": [
                        {
                          "id": 459,
                          "status": "available",
                          "startDate": "2016-11-08T09:00:00.000+08:00"
                        },
                        {
                          "id": 460,
                          "status": "available",
                          "startDate": "2016-11-08T10:00:00.000+08:00"
                        }
                    ]
                }
            ]
        }

## Store Delivery Timeslots v2 [/api/stores/{id}/delivery_timeslots]
API for updating store timeslots for partner

+ Parameters
    + id (required, string, `2`) ... Store id

### Store Delivery Timeslots v2 [PUT]
+ Request 200 (application/json; charset=utf-8)
    + Headers

            Accept: application/vnd.honestbee+json;version=2

    + Body

            {
                "deliveryTimeslots": [
                    {
                        "id":450,
                        "status": "available"
                    },
                    {
                        "id":451,
                        "status": "not_available"
                    }
                ],
                "accessToken": "66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6"
            }

+ Response 200 (application/json; charset=utf-8)

        {
            "ok": true
        }

## Store Products/Search Products v2 [/api/stores/{id}?q={q}&zoneId={zoneId}&categoryIds%5B%5D={categoryIds}&departmentIds%5B%5D={departmentIds}&fields%5B%5D={fields}&sort={sort}&page={page}&pageSize={pageSize}&aggLimit={aggLimit}]
API for listing products for search results page

+ Parameters
    + id (required, string, `2`) ... Store id
    + q (optional, string, `lotus`) ... The search text
    + zoneId (optional, number, `1`) ... The zone id, if zone does not match with store, will return 404
    + fields (optional, array, `categories`) ... if set, the categories won’t have pagination due to the nature of aggregation, default limit to 100 results, e.g. `categories`, `departments`
    + aggLimit (optional, number, `50`) ... override aggregation limit of 100
    + categoryIds (optional, array, ``) ... Category filter to filter results for certain categories
    + departmentIds (optional, array, `2`) ... Department filter to filter results for certain departments
    + sort (optional, string, `price:asc`) ... Sorting method, default to `relevance` if `q` is present, default to `popularity` if `q` is not present, others: `price:asc`, `price:desc`, `popularity`
    + page (optional, number, `1`) ... Current page of results, default to `1`
    + pageSize (optional, number, `10`) ... Number of items for each page of results, default to `48`

### Store Products v2 [GET]

+ Request 200

    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

        {
            "products": [],
            "meta": {
                "current_page": 1,
                "total_pages": 0,
                "total_count": 0
            },
            "categories": [
                {
                    "id": 76,
                    "title": "Biscuits",
                    "slug": "8-biscuits",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 3
                },
                {
                    "id": 56,
                    "title": "Breads",
                    "slug": "6-breads",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 1
                },
                {
                    "id": 120,
                    "title": "Tissues & Wipes",
                    "slug": "14-tissues-wipes",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 1
                }
            ]
        }

### Store OrderFulfillment (for partner) v2
API for listing the bee's own order fulfillments and all of the unassigned fulfillments of the store
if bee has binded store and store_id parameter provided

+ Parameters
    + store_id (required, number, `2`) ... Store id
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + role (required, string, `shopper`) ... The role of this order
    + status (optional, string, ``) ... the status to filter by.  If unspecified, all fulfillments for the role and user are returned.

+ Request 200
    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

+ Body

        {
            "id": 3,
            "trackingNumber": "125",
            "estimatedDeliveryDate": "2015-01-03T13:40:00.000+08:00",
            "deliveredDate": null,
            "deliveryTimeslot": {
                "id": 693,
                "timeslot": {
                    "startDate": "2015-04-20T19:00:00.000+08:00",
                    "endDate": "2015-04-20T20:00:00.000+08:00"
                }
            },
            "fulfillmentType": "worker",
            "fulfillmentStatus": "fulfillment_requested_assignment",
            "specialTreatmentTags": null,
            "orderItemsCount": 0,
            "fulfilledItemsCount": 0,
            "replacedItemsCount": 0,
            "adjustmentAmount": "0",
            "conciergeFee": null,
            "delivererStatus": "deliverer_pending_acceptance",
            "shopperStatus": "shopper_pending_acceptance",
            "delivererNotifiedAt": null,
            "shopperNotifiedAt": null,
            "notesToShopper": "The deliverer will be late",
            "notesToDeliverer": "The shopper will be late",
            "pickupNotes": "Please meet at the MRT",
            "pickupLatitude": "1.302",
            "pickupLongitude": "103.4",
            "pickupTime": null,
            "order": {
                "id": 2,
                "orderGuid": "487eddd3-89bb-4a33-b021-f77fbb42791b",
                "orderNumber": 1001,
                "contactPhoneNumber": null,
                "status": "delivered",
                "totalAmount": "154.0",
                "paymentCompletedDate": "2015-02-01T00:00:00.000+08:00",
                "shippingTrackingNumber": "DEF456",
                "deliveredDate": "2015-02-02T00:00:00.000+08:00",
                "discountAmount": null,
                "user": {
                    "id": 1,
                    "email": "chris@honestbee.com",
                    "name": "Chris Wang",
                    "mobileNumber": "44444444",
                    "imageUrl": "https://lifeopp.blob.core.windows.net/entity/243731_141015090457_192.jpg"
                },
                "customerNotes": null,
                "requiresShipping": true,
                "shippingAddress": {
                    "id": 1,
                    "name": "Monstro Mart",
                    "addressType": "home",
                    "address1": "Brickson Park",
                    "address2": null,
                    "unit": "9",
                    "city": null,
                    "state": null,
                    "country": "Mauritius",
                    "region": null,
                    "postalCode": "13566-6890",
                    "latitude": null,
                    "longitude": null,
                    "notes": null,
                    "building": "10",
                    "floor": "6",
                    "company": "Tavu"
                },
                "replacementPreference": "call_to_confirm_replacements",
                "country": {
                    "id": 1,
                    "countryCode": "SG"
                }
            },
            "shopper": {
                "id": 1,
                "email": "chris@honestbee.com",
                "name": "Chris Wang",
                "mobileNumber": "44444444",
                "imageUrl": "https://lifeopp.blob.core.windows.net/entity/243731_141015090457_192.jpg"
            },
            "coordinator": {
                "id": 3,
                "email": "jonathan@honestbee.com",
                "name": "Jonathan Low",
                "mobileNumber": "44444444",
                "imageUrl": "https://lifeopp.blob.core.windows.net/entity/243731_141015090457_192.jpg"
            },
            "deliverer": {
                "id": 2,
                "email": "grace@honestbee.com",
                "name": "Grace Zhang",
                "mobileNumber": "33333333",
                "imageUrl": "https://devlifeopp.blob.core.windows.net/entity/18170_141016093502_192.jpg"
            },
            "store": {
                "id": 3,
                "name": "Fair Price",
                "slug": "fair-price",
                "brandId": 3,
                "addressId": 3,
                "catalogId": 3,
                "priority": null,
                "notes": "",
                "description": "",
                "imageUrl": "fair-price.png",
                "brand": {
                    "id": 3,
                    "name": "Fair Price",
                    "slug": "fair-price",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/fair-price.jpg",
                    "minimumOrderFreeDelivery": "80.0",
                    "defaultDeliveryFee": "10.0"
                },
                "address": {
                    "id": 3,
                    "name": "Twimm",
                    "addressType": "home",
                    "address1": "Zoozzy",
                    "address2": "Yotz",
                    "unit": "12",
                    "city": "Chengdu",
                    "state": "Sichuan",
                    "country": "sg",
                    "region": null,
                    "postalCode": "228396",
                    "latitude": null,
                    "longitude": null,
                    "notes": null,
                    "building": "33",
                    "floor": "15",
                    "company": "Yotz"
                }
            },
            "orderItems": []
        }

# Group Product
Currently, we are only storing the image url and and the preview image url.  If we want to add more product images, these should be stored in a separate table.

## Products Collection [/api/products]

### List of product[GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 7877,
                    "title": "Leaf Lime 50G",
                    "description": null,
                    "imageUrl": "https://instamart.s3.amazonaws.com/cs2_sm/55569.jpg",
                    "previewImageUrl": "https://instamart.s3.amazonaws.com/cs2_sm/55569.jpg",
                    "price": "1.9",
                    "slug": "55569-leaf-lime-50-g",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "50G",
                    "status":"status_available",
                    "imageUrlBasename": "55569.jpg"
                },
                {
                    "id": 14746,
                    "title": "G/Phoenix H/Brown Patties 1276G(20S)",
                    "description": null,
                    "imageUrl": "https://instamart.s3.amazonaws.com/images/0008911_125.png",
                    "previewImageUrl": "https://instamart.s3.amazonaws.com/images/0008911_125.png",
                    "price": "5.5",
                    "slug": "31552-g-phoenix-h-brown-patties-1276g-20s",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "1276g (20S)",
                    "status":"status_available",
                    "imageUrlBasename": "0008911_125.jpg"
                }
            ]

## Product [/api/products/{id}]

+ Parameters
    + id (required, number, `10`) ... Product id

### Retrieve a Product [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "id": 10,
                "title": "Masterfoods Cinnamon Ground",
                "description": null,
                "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_49431_faee9d538ed3d0eba4564a002ec5a814.jpg",
                "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_49431_faee9d538ed3d0eba4564a002ec5a814.jpg",
                "price": "4.95",
                "slug": "masterfoods-cinnamon-ground-28g",
                "barcode": null,
                "unitType": "unit_type_item",
                "soldBy": "sold_by_item",
                "amountPerUnit": "1.0",
                "normalPrice": null,
                "size": "28G",
                "status":"status_available",
                "imageUrlBasename": "1_49431_faee9d538ed3d0eba4564a002ec5a814.jpg"
            }

## Products Collection for Catalog [/api/catalogs/{catalogId}/products]

+ Parameters
    + catalogId (required, number, `2`) ... The catalog id

### List of Products for the given catalog id [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 7877,
                    "title": "Leaf Lime 50G",
                    "description": null,
                    "imageUrl": "https://instamart.s3.amazonaws.com/cs2_sm/55569.jpg",
                    "previewImageUrl": "https://instamart.s3.amazonaws.com/cs2_sm/55569.jpg",
                    "price": "1.9",
                    "slug": "55569-leaf-lime-50-g",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "50G",
                    "status":"status_available",
                    "imageUrlBasename": "55569.jpg"
                },
                {
                    "id": 883,
                    "title": "ALOHA Banana Cavendish Philippines ~ 1KG 1KG",
                    "description": null,
                    "imageUrl": "https://instamart.s3.amazonaws.com/cs2_sm/73588.jpg",
                    "previewImageUrl": "https://instamart.s3.amazonaws.com/cs2_sm/73588.jpg",
                    "price": "2.55",
                    "slug": "73588-aloha-banana-philippines",
                    "barcode": null,
                    "unitType": "unitTypeGrams",
                    "soldBy": "soldByWeight",
                    "amountPerUnit": "250.0",
                    "normalPrice": null,
                    "size": "~ 1KG",
                    "status":"status_available",
                    "imageUrlBasename": "55569.jpg"
                }
            ]

## Products Collection for Category [/api/categories/{categoryId}/products]

+ Parameters
    + categoryId (required, number, `5`) ... The category id

### List of Product for the given category id [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 95790,
                    "title": "Energizer Mini Charger CH2PC3 AAA",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/000_default_product_photo.png",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/000_default_product_photo.png",
                    "price": "20.75",
                    "slug": "energizer-mini-charger-ch2pc3-aaa",
                    "barcode": null,
                    "unitType": "unit_type_pack",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": null,
                    "status":"status_available",
                    "imageUrlBasename": "000_default_product_photo.png"
                },
                {
                    "id": 95791,
                    "title": "Energizer Recharge Value CHVCM4 Aa",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/000_default_product_photo.png",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/000_default_product_photo.png",
                    "price": "24.05",
                    "slug": "energizer-recharge-value-chvcm4-aa",
                    "barcode": null,
                    "unitType": "unit_type_pack",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": null,
                    "status":"status_available",
                    "imageUrlBasename": "000_default_product_photo.png"
                },
                {
                    "id": 95792,
                    "title": "Eveready Super Heavy Duty AAA8 1212BP8",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/000_default_product_photo.png",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/000_default_product_photo.png",
                    "price": "4.35",
                    "slug": "eveready-super-heavy-duty-aaa8-1212bp8",
                    "barcode": null,
                    "unitType": "unit_type_pack",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": null,
                    "status":"status_available",
                    "imageUrlBasename": "000_default_product_photo.png"
                },
                {
                    "id": 95793,
                    "title": "Eveready Super Heavy Duty D2 1250BP2",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/000_default_product_photo.png",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/000_default_product_photo.png",
                    "price": "2.35",
                    "slug": "eveready-super-heavy-duty-d2-1250bp2",
                    "barcode": null,
                    "unitType": "unit_type_pack",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": null,
                    "status":"status_available",
                    "imageUrlBasename": "000_default_product_photo.png"
                },
                {
                    "id": 95794,
                    "title": "Gp Greencell Ex Heavy Duty D2",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_44683_0024131_0.png",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_44683_0024131_0.png",
                    "price": "1.3",
                    "slug": "gp-greencell-ex-heavy-duty-d2",
                    "barcode": null,
                    "unitType": "unit_type_pack",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": null,
                    "status":"status_available",
                    "imageUrlBasename": "3_44683_0024131_0.png"
                },
                {
                    "id": 95795,
                    "title": "Gp Ultra Alkaline AA4+2",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_47873_0016573_0.png",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_47873_0016573_0.png",
                    "price": "2.5",
                    "slug": "gp-ultra-alkaline-aa4-2",
                    "barcode": null,
                    "unitType": "unit_type_pack",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": null,
                    "status":"status_available",
                    "imageUrlBasename": "3_47873_0016573_0.png"
                },
                {
                    "id": 95796,
                    "title": "Gp Ultra Alkaline AAA4+2",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_47872_0016570_0.png",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_47872_0016570_0.png",
                    "price": "2.5",
                    "slug": "gp-ultra-alkaline-aaa4-2",
                    "barcode": null,
                    "unitType": "unit_type_pack",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": null,
                    "status":"status_available",
                    "imageUrlBasename": "3_47872_0016570_0.png"
                }
            ]

## Products Collection for Category and Catalog [/api/catalogs/{catalogId}/categories/{categoryId}/products]

+ Parameters
    + catalogId (required, number, `2`) ... The catalog id
    + categoryId (required, number, `59`) ... The category id

### List of Product for the given catalog and category id [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 101065,
                    "title": "First Choice Dehumidifier 3 S",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_112015_8764c823bdb29a1301572cdebace6500.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_112015_8764c823bdb29a1301572cdebace6500.jpg",
                    "price": "4.5",
                    "slug": "first-choice-dehumidifier-3-s-450ml",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "450ML",
                    "status":"status_available",
                    "imageUrlBasename": "1_112015_8764c823bdb29a1301572cdebace6500.jpg"
                },
                {
                    "id": 101066,
                    "title": "First Choice Deodoriser Shoe Cabinet",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_21729_959a9e4eb7f393cedbeed3a5639298e6.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_21729_959a9e4eb7f393cedbeed3a5639298e6.jpg",
                    "price": "2.85",
                    "slug": "first-choice-deodoriser-shoe-cabinet",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": null,
                    "status":"status_available",
                    "imageUrlBasename": "1_21729_959a9e4eb7f393cedbeed3a5639298e6.jpg"
                },
                {
                    "id": 101067,
                    "title": "Hakugen Dry&Dry For Warerobe Hk 69",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_44337_07a7eaed2f98734fe626e0b32184f0ff.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_44337_07a7eaed2f98734fe626e0b32184f0ff.jpg",
                    "price": "4.2",
                    "slug": "hakugen-dry-dry-for-warerobe-hk-69-70gm",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "70GM",
                    "status":"status_available",
                    "imageUrlBasename": "1_44337_07a7eaed2f98734fe626e0b32184f0ff.jpg"
                },
                {
                    "id": 101068,
                    "title": "Thirsty Hippo Dehumidifier",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_105930_8ad015ce2a6e0e0bf85a05f9de0a142d.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_105930_8ad015ce2a6e0e0bf85a05f9de0a142d.jpg",
                    "price": "9.7",
                    "slug": "thirsty-hippo-dehumidifier-3s",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "3S",
                    "status":"status_available",
                    "imageUrlBasename": "1_105930_8ad015ce2a6e0e0bf85a05f9de0a142d.jpg"
                },
                {
                    "id": 101069,
                    "title": "Thirsty Hippo Dehumidifier Sachet",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_136465_2d7a6d8f6f2b68a1c6ff6e341fc2f8dc.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_136465_2d7a6d8f6f2b68a1c6ff6e341fc2f8dc.jpg",
                    "price": "6.05",
                    "slug": "thirsty-hippo-dehumidifier-sachet-4s",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "4S",
                    "status":"status_available",
                    "imageUrlBasename": "1_136465_2d7a6d8f6f2b68a1c6ff6e341fc2f8dc.jpg"
                },
                {
                    "id": 101070,
                    "title": "Airwick Aerosol 4 In1 Lavender",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_145898_932c3a2faed39506f0facbbb9d253de0.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_145898_932c3a2faed39506f0facbbb9d253de0.jpg",
                    "price": "3.75",
                    "slug": "airwick-aerosol-4-in1-lavender-300ml",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "300ML",
                    "status":"status_available",
                    "imageUrlBasename": "1_145898_932c3a2faed39506f0facbbb9d253de0.jpg"
                },
                {
                    "id": 101071,
                    "title": "Airwick Aerosol 4 In1 Sparkling Citrus",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_100330_4d04af8a58cf5537be9ccbd957f4c19a.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_100330_4d04af8a58cf5537be9ccbd957f4c19a.jpg",
                    "price": "3.75",
                    "slug": "airwick-aerosol-4-in1-sparkling-citrus-300ml",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "300ML",
                    "status":"status_available",
                    "imageUrlBasename": "1_100330_4d04af8a58cf5537be9ccbd957f4c19a.jpg"
                },
                {
                    "id": 101072,
                    "title": "Airwick Aquamist Floral",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_36378_2fbe49e2a6b9847853ff315d902ae7c6.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_36378_2fbe49e2a6b9847853ff315d902ae7c6.jpg",
                    "price": "5.85",
                    "slug": "airwick-aquamist-floral-345ml",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "345ML",
                    "status":"status_available",
                    "imageUrlBasename": "1_36378_2fbe49e2a6b9847853ff315d902ae7c6.jpg"
                },
                {
                    "id": 101073,
                    "title": "Airwick Aquamist Jasmine",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_36379_5a8556a99b7d428d5cae24415d83dd21.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_36379_5a8556a99b7d428d5cae24415d83dd21.jpg",
                    "price": "5.85",
                    "slug": "airwick-aquamist-jasmine-345ml",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "345ML",
                    "status":"status_available",
                    "imageUrlBasename": "1_36379_5a8556a99b7d428d5cae24415d83dd21.jpg"
                },
                {
                    "id": 101074,
                    "title": "Airwick Aquamist Lavender",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_36380_f13e9fe8f13b47eb327c630a160df5d0.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_36380_f13e9fe8f13b47eb327c630a160df5d0.jpg",
                    "price": "5.85",
                    "slug": "airwick-aquamist-lavender-345ml",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "345ML",
                    "status":"status_available",
                    "imageUrlBasename": "1_36380_f13e9fe8f13b47eb327c630a160df5d0.jpg"
                },
                {
                    "id": 101075,
                    "title": "Airwick Autospray Floral Citrus",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_12523_6e5682c549d5fbf7a2fc97ece7752621.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_12523_6e5682c549d5fbf7a2fc97ece7752621.jpg",
                    "price": "11.4",
                    "slug": "airwick-autospray-floral-citrus",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": null,
                    "status":"status_available",
                    "imageUrlBasename": "1_12523_6e5682c549d5fbf7a2fc97ece7752621.jpg"
                },
                {
                    "id": 101076,
                    "title": "Airwick Autospray Floral Lavender",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_12518_9f01d1ffe8bbc8c06da022efd61870c7.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_12518_9f01d1ffe8bbc8c06da022efd61870c7.jpg",
                    "price": "11.4",
                    "slug": "airwick-autospray-floral-lavender",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": null,
                    "status":"status_available",
                    "imageUrlBasename": "1_12518_9f01d1ffe8bbc8c06da022efd61870c7.jpg"
                },
                {
                    "id": 101077,
                    "title": "Airwick Autospray Refill Freshwater",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_164535_dd5eeea2bc8b28e97d4c578450a78086.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_164535_dd5eeea2bc8b28e97d4c578450a78086.jpg",
                    "price": "8.3",
                    "slug": "airwick-autospray-refill-freshwater-280ml",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "280ML",
                    "status":"status_available",
                    "imageUrlBasename": "1_164535_dd5eeea2bc8b28e97d4c578450a78086.jpg"
                },
                {
                    "id": 101078,
                    "title": "Ambi Pur Air Effect Spray Lavender Vanilla",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_42999_bfcd8fe6b6d39f9a09a9e82311afb8e7.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_42999_bfcd8fe6b6d39f9a09a9e82311afb8e7.jpg",
                    "price": "7.2",
                    "slug": "ambi-pur-air-effect-spray-lavender-vanilla-275g",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "275G",
                    "status":"status_available",
                    "imageUrlBasename": "1_42999_bfcd8fe6b6d39f9a09a9e82311afb8e7.jpg"
                },
                {
                    "id": 101079,
                    "title": "Ambi Pur Air Effect Spray Spring Renewal",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_42997_486603345d33a110d126baa2d274b42f.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_42997_486603345d33a110d126baa2d274b42f.jpg",
                    "price": "7.2",
                    "slug": "ambi-pur-air-effect-spray-spring-renewal-275g",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "275G",
                    "status":"status_available",
                    "imageUrlBasename": "1_42997_486603345d33a110d126baa2d274b42f.jpg"
                },
                {
                    "id": 101080,
                    "title": "Ambi Pur Air Effect Spray Sweet Citrus",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_43006_f2251da8537afae1469304c22e75668a.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_43006_f2251da8537afae1469304c22e75668a.jpg",
                    "price": "7.2",
                    "slug": "ambi-pur-air-effect-spray-sweet-citrus-275g",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "275G",
                    "status":"status_available",
                    "imageUrlBasename": "1_43006_f2251da8537afae1469304c22e75668a.jpg"
                },
                {
                    "id": 101081,
                    "title": "Ambi Pur Flush Fresh Mint Starter",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_53214_3be71eadb669973a871037a5c21c5569.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_53214_3be71eadb669973a871037a5c21c5569.jpg",
                    "price": "4.1",
                    "slug": "ambi-pur-flush-fresh-mint-starter-55ml",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "55ML",
                    "status":"status_available",
                    "imageUrlBasename": "1_53214_3be71eadb669973a871037a5c21c5569.jpg"
                },
                {
                    "id": 101082,
                    "title": "Ambi Pur Flush Grapefruit Starter",
                    "description": null,
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_53216_5ab3c8ba156ef60ae9d2878761e0bf0f.jpg",
                    "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_53216_5ab3c8ba156ef60ae9d2878761e0bf0f.jpg",
                    "price": "4.1",
                    "slug": "ambi-pur-flush-grapefruit-starter-55ml",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "55ML",
                    "status":"status_available",
                    "imageUrlBasename": "1_53216_5ab3c8ba156ef60ae9d2878761e0bf0f.jpg"
                }
            ]

## Search Product [/api/product/search?q={q}&brand={brand}&zone={zone}]
The brand can be the id or slug

+ Parameters
    + q (required, string, `apple tea`) ... The search text
    + brand (optional, string, `2`) ... The brand id or slug, the value can be 1 or 'sheng-siong'
    + zone (optional, number, `1`) ... The zone id

### Get product for search [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 10,
                    "title": "Soft Drinks ",
                    "departmentId": 2,
                    "products": [
                        {
                            "id": 8385,
                            "title": "F&N Seasons Ice Apple Tea",
                            "description": "Enjoy F&N Seasons Ice Apple Tea and experience the combined benefits of apple and black tea in this apple-tizing drink brewed with real tea leaves, and containing healthy antioxidants. An apple a day keeps the doctor away, so they say!",
                            "imageUrl": "https://instamart.s3.amazonaws.com/images/IMG_8838.JPG",
                            "previewImageUrl": "https://instamart.s3.amazonaws.com/previews/IMG_8838.JPG",
                            "price": "1.85",
                            "slug": "f-n-seasons-ice-apple-tea",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy":"sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": "1.85",
                            "size": "425G",
                            "status":"status_available",
                            "imageUrlBasename": "IMG_8838.jpg"
                        },
                        {
                            "id": 8936,
                            "title": "Heaven and Earth Ice Apple Tea",
                            "description": "Refreshing and cooling black tea with juicy apple flavour to give you a sensational fruity tea taste.",
                            "imageUrl": "https://instamart.s3.amazonaws.com/images/IMG2660_1411963260737.JPG",
                            "previewImageUrl": "https://instamart.s3.amazonaws.com/previews/IMG2660_1411963260737.JPG",
                            "price": "2.05",
                            "slug": "heaven-and-earth-ice-apple-tea",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy":"sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": "2.05",
                            "size": "185G",
                            "status":"status_available",
                            "imageUrlBasename": "IMG2660_1411963260737.jpg"
                        }
                    ]
                },
                {
                    "id": 13,
                    "title": "Tea ",
                    "departmentId": 2,
                    "products": [
                        {
                            "id": 8754,
                            "title": "Ahmad Apple Refresh Flavoured Black Tea",
                            "description": "Charming and fragrant; enjoy hot or cold; the highest quality tea blended with refreshing apple",
                            "imageUrl": "https://instamart.s3.amazonaws.com/images/redmart-227.JPG",
                            "previewImageUrl": "https://instamart.s3.amazonaws.com/previews/redmart-227.JPG",
                            "price": "4.6",
                            "slug": "ahmad-apple-refresh-flavoured-black-tea",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy":"sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": "4.6",
                            "size": "185G",
                            "status":"status_available",
                            "imageUrlBasename": "redmart-227.jpg"
                        }
                    ]
                }
            ]

## Auto Search [/api/product/auto_search?q={q}&brand={brand}&zone={zone}]
The brand can be the id or slug

+ Parameters
    + q (required, string, `apple tea`) ... The search text
    + brand (optional, string, `2`) ... The brand id or slug, the value can be 1 or 'sheng-siong'
    + zone (optional, number, `1`) ... The zone id

### Get auto search [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 99998,
                    "title": "Seasons Iced Apple Tea",
                    "slug": "seasons-iced-apple-tea-1-5l",
                    "price": "1.95",
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_114953_6b1fc41e57f7e9808989cdddd95ee9de.jpg",
                    "size": "1.5L",
                    "imageUrlBasename": "1_114953_6b1fc41e57f7e9808989cdddd95ee9de.jpg"
                },
                {
                    "id": 92828,
                    "title": "Seasons Ice Apple Tea",
                    "slug": "seasons-ice-apple-tea-1-5l",
                    "price": "1.85",
                    "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_1415_0000721_0.png",
                    "size": "1.5L",
                    "imageUrlBasename": "3_1415_0000721_0.png"
                }
            ]

## Replacement suggestion [/api/products/replacement_suggestions?productIds={productIds}]

+ Parameters
    + productIds (required, string, `7877,14746`) ... comma separated ordered product ids

### Get replacement suggestion [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "requestedProductId": 7877,
                    "id": 9237,
                    "title": "Leaf Lime 50G",
                    "description": null,
                    "imageUrl": "https://instamart.s3.amazonaws.com/cs2_sm/55569.jpg",
                    "previewImageUrl": "https://instamart.s3.amazonaws.com/cs2_sm/55569.jpg",
                    "price": "1.9",
                    "slug": "55569-leaf-lime-50-g",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "50G",
                    "status":"status_available",
                    "imageUrlBasename": "55569.jpg"
                },
                {
                    "requestedProductId": 14746,
                    "id": 13425,
                    "title": "G/Phoenix H/Brown Patties 1276G(20S)",
                    "description": null,
                    "imageUrl": "https://instamart.s3.amazonaws.com/images/0008911_125.png",
                    "previewImageUrl": "https://instamart.s3.amazonaws.com/images/0008911_125.png",
                    "price": "5.5",
                    "slug": "31552-g-phoenix-h-brown-patties-1276g-20s",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "normalPrice": null,
                    "size": "1276g (20S)",
                    "status":"status_available",
                    "imageUrlBasename": "0008911_125.jpg"
                }
            ]

## Update Product store inventory status V2 [/api/products/{id}/store_inventory?storeId={storeId}&stockStatus={stockStatus}]
The store inventory status could exists only one day `Time.zone.today`. After that, the inventory status will be expired.

+ Parameters
    + id (required, integer, `10`) ... Product id
    + storeId (required, number, `2`) ... Store id
    + stockStatus (required, string, `status_available`) ... Status for product, the value can be 'status_available' or 'status_out_of_stock'

### Update Product store inventory status V2 [PUT]

+ Response 200 (application/json)

    + Body

            {
                "ok": true
            }


# Group Category
The categories for products which belong to a department.
These categories can be hierarchical.

## Categories Collection [/api/departments/{departmentId}/categories?fields={fields}]
Get categories for the department, if pass in fields "featured_products" or "products", will return list with products.

+ Parameters
    + departmentId (required, number, `25`) ... The department id
    + fields (optional, string, `featured_products,products`) ... Get list with products, can pass in "featured_products" or "products".

### List of Category for Department[GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 84,
                    "title": "Fresh Fruit",
                    "slug": "fresh-fruit",
                    "imageUrl": "",
                    "featuredProducts": [
                        {
                            "id": 13642,
                            "title": "Kellogg's Coco Chex 330G(I)",
                            "description": null,
                            "imageUrl": "https://instamart.s3.amazonaws.com/images/0010693_125.png",
                            "previewImageUrl": "https://instamart.s3.amazonaws.com/images/0010693_125.png",
                            "price": "5.25",
                            "slug": "56431-kellogg-s-coco-chex-330g-i",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "imageUrlBasename": "0010693_125.png"
                        },
                        {
                            "id": 13646,
                            "title": "Nestle Koko Krunch Multipack 6X25G",
                            "description": null,
                            "imageUrl": "https://instamart.s3.amazonaws.com/images/0000811_125.png",
                            "previewImageUrl": "https://instamart.s3.amazonaws.com/images/0000811_125.png",
                            "price": "3.15",
                            "slug": "1556-nestle-koko-krunch-multipack-6x25g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "imageUrlBasename": "0000811_125.png"
                        }
                    ],
                    "products": [
                        {
                            "id": 13642,
                            "title": "Kellogg's Coco Chex 330G(I)",
                            "description": null,
                            "imageUrl": "https://instamart.s3.amazonaws.com/images/0010693_125.png",
                            "previewImageUrl": "https://instamart.s3.amazonaws.com/images/0010693_125.png",
                            "price": "5.25",
                            "slug": "56431-kellogg-s-coco-chex-330g-i",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "330g",
                            "status":"status_available",
                            "imageUrlBasename": "0010693_125.png"
                        },
                        {
                            "id": 13646,
                            "title": "Nestle Koko Krunch Multipack 6X25G",
                            "description": null,
                            "imageUrl": "https://instamart.s3.amazonaws.com/images/0000811_125.png",
                            "previewImageUrl": "https://instamart.s3.amazonaws.com/images/0000811_125.png",
                            "price": "3.15",
                            "slug": "1556-nestle-koko-krunch-multipack-6x25g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "6x25g",
                            "status":"status_available",
                            "imageUrlBasename": "0000811_125.png"
                        }
                    ]
                },
                {
                    "id": 85,
                    "title": "Fresh Vegetables",
                    "slug": "fresh-vegetables",
                    "imageUrl": "",
                    "featuredProducts": [],
                    "products": []
                }
            ]

## Categories Collection with Featured Product [/api/departments/{departmentId}/categories?fields={fields}&has_product={has_product}]
Get categories for the department, if pass in fields "featured_products" or "products", will return list with products.

+ Parameters
    + departmentId (required, number, `25`) ... The department id
    + fields (optional, string, `featured_products,products`) ... Get list with products, can pass in "featured_products" or "products".
    + has_product (optional, string, `true`) ... If set to true, won't return the item without any featured products

### List of Category for Department[GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 5634,
                    "title": "Beers",
                    "slug": "597-beers",
                    "imageUrl": null,
                    "featuredProducts": [
                        {
                            "id": 91831,
                            "title": "Tiger Beer",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_75848_0030306_0.png",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_75848_0030306_0.png",
                            "price": "18.0",
                            "slug": "tiger-beer-6s-323ml",
                            "barcode": null,
                            "unitType": "unit_type_pack",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "6S 323ML",
                            "imageUrlBasename": "3_75848_0030306_0.png"
                        },
                        {
                            "id": 92983,
                            "title": "Hooper's Hooch Orange Vodka",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_77227_0041799_0.png",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_77227_0041799_0.png",
                            "price": "4.7",
                            "slug": "hooper-s-hooch-orange-vodka-275ml",
                            "barcode": null,
                            "unitType": "unit_type_pack",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "275ML",
                            "imageUrlBasename": "3_77227_0041799_0.png"
                        }
                    ],
                    "products": [
                        {
                            "id": 91831,
                            "title": "Tiger Beer",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_75848_0030306_0.png",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_75848_0030306_0.png",
                            "price": "18.0",
                            "slug": "tiger-beer-6s-323ml",
                            "barcode": null,
                            "unitType": "unit_type_pack",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "6S 323ML",
                            "status":"status_available",
                            "imageUrlBasename": "3_75848_0030306_0.png"
                        },
                        {
                            "id": 91832,
                            "title": "Baron's Strong Brew",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_1827_0003211_0.png",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/3_1827_0003211_0.png",
                            "price": "5.6",
                            "slug": "baron-s-strong-brew-500ml",
                            "barcode": null,
                            "unitType": "unit_type_pack",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "500ML",
                            "status":"status_available",
                            "imageUrlBasename": "3_1827_0003211_0.png"
                        }
                    ]
                },
                {
                    "id": 5638,
                    "title": "Brandy & Rum",
                    "slug": "597-brandy-rum",
                    "imageUrl": null,
                    "featuredProducts": [
                        {
                            "id": 93129,
                            "title": "Old Cask Rum",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/000_default_product_photo.png",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/000_default_product_photo.png",
                            "price": "44.6",
                            "slug": "old-cask-rum-750ml",
                            "barcode": null,
                            "unitType": "unit_type_pack",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "750ML",
                            "imageUrlBasename": "000_default_product_photo.png"
                        }
                    ],
                    "products": [
                        {
                            "id": 93129,
                            "title": "Old Cask Rum",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/000_default_product_photo.png",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/000_default_product_photo.png",
                            "price": "44.6",
                            "slug": "old-cask-rum-750ml",
                            "barcode": null,
                            "unitType": "unit_type_pack",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "750ML",
                            "status":"status_available",
                            "imageUrlBasename": "000_default_product_photo.png"
                        }
                    ]
                }
            ]

## Category [/api/categories/{id}?fields={fields}]

+ Parameters
    + id (required, number, `3`) ... The category id
    + fields (optional, string, `featured_products,products`) ... Get list with products, can pass in "featured_products" or "products"

### Retrieve a Category [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "id": 1699,
                "title": "Others",
                "slug": "82-others",
                "imageUrl": null,
                "featuredProducts": [
                    {
                        "id": 9138,
                        "title": "Singlong Bean Mee (Tau Chiam) 250G",
                        "description": null,
                        "imageUrl": "https://instamart.s3.amazonaws.com/fp_xl/11164588_XL1.jpg",
                        "previewImageUrl": "https://instamart.s3.amazonaws.com/fp_xl/11164588_XL1.jpg",
                        "price": "1.45",
                        "slug": "20516-singlong-bean-mee-tau-chiam-250g",
                        "barcode": null,
                        "unitType": "unit_type_item",
                        "soldBy": "sold_by_item",
                        "amountPerUnit": "1.0",
                        "normalPrice": null,
                        "imageUrlBasename": "11164588_XL1.jpg"
                    },
                    {
                        "id": 9139,
                        "title": "Sing Long White Jade Noodles 340G",
                        "description": null,
                        "imageUrl": "https://instamart.s3.amazonaws.com/fp_xl/456766_XL1.jpg",
                        "previewImageUrl": "https://instamart.s3.amazonaws.com/fp_xl/456766_XL1.jpg",
                        "price": "1.8",
                        "slug": "17758-sing-long-white-jade-noodles-340g",
                        "barcode": null,
                        "unitType": "unit_type_item",
                        "soldBy": "sold_by_item",
                        "amountPerUnit": "1.0",
                        "normalPrice": null,
                        "imageUrlBasename": "456766_XL1.jpg"
                    }
                ],
                "products": [
                    {
                        "id": 9138,
                        "title": "Singlong Bean Mee (Tau Chiam) 250G",
                        "description": null,
                        "imageUrl": "https://instamart.s3.amazonaws.com/fp_xl/11164588_XL1.jpg",
                        "previewImageUrl": "https://instamart.s3.amazonaws.com/fp_xl/11164588_XL1.jpg",
                        "price": "1.45",
                        "slug": "20516-singlong-bean-mee-tau-chiam-250g",
                        "barcode": null,
                        "unitType": "unit_type_item",
                        "soldBy": "sold_by_item",
                        "amountPerUnit": "1.0",
                        "normalPrice": null,
                        "size": "340G",
                        "status":"status_available",
                        "imageUrlBasename": "11164588_XL1.jpg"
                    },
                    {
                        "id": 9153,
                        "title": "Nongshim An Sung Tang Myun Hot & Spicy 125G",
                        "description": null,
                        "imageUrl": "https://instamart.s3.amazonaws.com/fp_xl/11012947_XL1.jpg",
                        "previewImageUrl": "https://instamart.s3.amazonaws.com/fp_xl/11012947_XL1.jpg",
                        "price": "5.25",
                        "slug": "73152-nongshim-an-sung-tang-myun-hot-spicy-125g",
                        "barcode": null,
                        "unitType": "unit_type_item",
                        "soldBy": "sold_by_item",
                        "amountPerUnit": "1.0",
                        "normalPrice": null,
                        "size": "340G",
                        "status":"status_available",
                        "imageUrlBasename": "11012947_XL1.jpg"
                    }
                ]
            }

# Group Department
The department specifies the top level categorization of products.  Departments are specified as separate from categories as user permissions may want to be specified for access to departments.

## Department [/api/departments/{id}?fields={fields}]

+ Parameters
    + id (required, number, `25`) ... The department id
    + fields (optional, string, `featured_products,categories`) ... The additional fields to return

### Retrieve a Department [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "id": 609,
                "name": "Bakery",
                "description": null,
                "imageUrl": null,
                "featuredProducts": [
                    {
                        "id": 14078,
                        "title": "Homestyle Brownies",
                        "description": null,
                        "imageUrl": "https://instamart.s3.amazonaws.com/cs_sm/080108.jpg",
                        "previewImageUrl": "https://instamart.s3.amazonaws.com/cs_sm/080108.jpg",
                        "price": "2.1",
                        "slug": "homestyle-brownies",
                        "barcode": null,
                        "unitType": "0",
                        "size": "0",
                        "normalPrice": "2.1",
                        "imageUrlBasename": "080108.jpg"
                    },
                    {
                        "id": 14077,
                        "title": "Quix Waffles",
                        "description": null,
                        "imageUrl": "https://instamart.s3.amazonaws.com/cs_sm/075396.jpg",
                        "previewImageUrl": "https://instamart.s3.amazonaws.com/cs_sm/075396.jpg",
                        "price": "4.5",
                        "slug": "quix-waffles",
                        "barcode": null,
                        "unitType": "0",
                        "size": "0",
                        "normalPrice": "4.5",
                        "imageUrlBasename": "075396.jpg"
                    }
                ],
                "categories": [
                    {
                        "id": 143,
                        "title": "Premium Cookies",
                        "slug": "premium-cookies",
                        "imageUrl": null
                    },
                    {
                        "id": 142,
                        "title": "Gourmet Waffles",
                        "slug": "gourmet-waffles",
                        "imageUrl": null
                    }
                ]
            }

## Departments Collection [/api/zones/{zoneId}/brands/{brandId}/departments?fields={fields}]
This is the department list by the given zone id and brand id, if pass in fields, will get the related data within department

+ Parameters
    + zoneId (required, number, `1`) ... The zone id
    + brandId (required, string, `2`) ... The brand id or brand slug, so can be 2 or 'cold-storage'
    + fields (optional, string, `featured_products,categories`) ... The additional fields to return

### List of Departments for Zone and Brand [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id" : 4,
                    "name" : "drink",
                    "description" : "this is drink department",
                    "imageUrl" : "",
                    "featuredProducts" : [],
                    "categories" :
                    [
                        {
                            "id": 127,
                            "title": "Greek Cheese",
                            "slug": "greek-cheese",
                            "imageUrl": null
                        }
                    ]
                }, {
                    "id" : 1,
                    "name" : "meat and seafood",
                    "description" : "this is for meat and seafood",
                    "imageUrl" : "",
                    "featuredProducts" : [],
                    "categories" : []
                }, {
                    "id" : 2,
                    "name" : "breakfast",
                    "description" : "this is breakfast department",
                    "imageUrl" : "",
                    "featuredProducts" :
                    [
                        {
                            "id": 14393,
                            "title": "First Choice Fc P Greek Feta",
                            "description": null,
                            "imageUrl": "https://instamart.s3.amazonaws.com/cs_sm/070951.jpg",
                            "previewImageUrl": "https://instamart.s3.amazonaws.com/cs_sm/070951.jpg",
                            "price": "43.9",
                            "slug": "first-choice-fc-p-greek-feta",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy":"sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": "43.9",
                            "imageUrlBasename": "070951.jpg"
                        }
                    ],
                    "categories" : []
                }
            ]

## Departments Collection with Featured Product [/api/zones/{zoneId}/brands/{brandId}/departments?fields={fields}&has_product={has_product}]
This is the department list by the given zone id and brand id, if pass in fields, will get the related data within department

+ Parameters
    + zoneId (required, number, `1`) ... The zone id
    + brandId (required, string, `2`) ... The brand id or brand slug, so can be 2 or 'cold-storage'
    + fields (optional, string, `featured_products,categories`) ... The additional fields to return
    + has_product (optional, string, `true`) ... If set to true, won't return the item without any featured products

### List of Departments for Zone and Brand [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id" : 2,
                    "name" : "breakfast",
                    "description" : "this is breakfast department",
                    "imageUrl" : "",
                    "featuredProducts" :
                    [
                        {
                            "id": 14393,
                            "title": "First Choice Fc P Greek Feta",
                            "description": null,
                            "imageUrl": "https://instamart.s3.amazonaws.com/cs_sm/070951.jpg",
                            "previewImageUrl": "https://instamart.s3.amazonaws.com/cs_sm/070951.jpg",
                            "price": "43.9",
                            "slug": "first-choice-fc-p-greek-feta",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy":"sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": "43.9"
                        }
                    ],
                    "categories" : []
                }
            ]

## Department Products v2 [/api/departments/{id}?categoryIds%5B%5D={categoryIds}&fields%5B%5D={fields}&sort={sort}&page={page}&pageSize={pageSize}&aggLimit={aggLimit}]
API for listing products for a department

+ Parameters
    + id (required, string, `1`) ... Department id
    + fields (optional, array, `categories`) ... if set, the categories won’t have pagination due to the nature of aggregation, default limit to 100 results
    + aggLimit (optional, number, `50`) ... override aggregation limit of 100
    + categoryIds (optional, array, `2`) ... Category filter to filter results for certain categories
    + sort (optional, string, `price:asc`) ... Sorting method, default to `relevance`, others: `price`, `price:desc`
    + page (optional, number, `2`) ... Current page of results, default to `1`
    + pageSize (optional, number, `10`) ... Number of items for each page of results, default to `48`

### Department Products v2 [GET]
+ Request 200

    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

        {
            "products": [
                {
                    "id": 43,
                    "title": "Orange Navel Large, USA",
                    "description": null,
                    "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_20603_18c9dbb72bb4222d524da0ec60802698.jpg",
                    "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_20603_18c9dbb72bb4222d524da0ec60802698.jpg",
                    "slug": "orange-navel-large-usa",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "size": "each",
                    "status": "status_available",
                    "imageUrlBasename": "1_20603_18c9dbb72bb4222d524da0ec60802698.jpg",
                    "currency": "SGD",
                    "price": "1.9",
                    "normalPrice": "1.9"
                },
                {
                    "id": 6261,
                    "title": "Pear Packham Australia 48/54C",
                    "description": null,
                    "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/000_default_product_photo.png",
                    "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/000_default_product_photo.png",
                    "slug": "pear-packham-australia-48-54c",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "size": "each",
                    "status": "status_available",
                    "imageUrlBasename": "000_default_product_photo.png",
                    "currency": "SGD",
                    "price": "2.45",
                    "normalPrice": "2.45"
                },
                {
                    "id": 5,
                    "title": "Apple Envy (New Zealand)",
                    "description": null,
                    "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_85743_c0e22d404500401440be7a0a3215e908.jpg",
                    "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_85743_c0e22d404500401440be7a0a3215e908.jpg",
                    "slug": "apple-envy-new-zealand",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "size": "each",
                    "status": "status_available",
                    "imageUrlBasename": "1_85743_c0e22d404500401440be7a0a3215e908.jpg",
                    "currency": "SGD",
                    "price": "2.45",
                    "normalPrice": "2.45"
                },
                {
                    "id": 21,
                    "title": "Prepacked Starfruit (Malaysia)",
                    "description": null,
                    "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_79245_968169839ec0fa228966a376fa846fc1.jpg",
                    "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_79245_968169839ec0fa228966a376fa846fc1.jpg",
                    "slug": "prepacked-starfruit-malaysia",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "size": "500 g",
                    "status": "status_available",
                    "imageUrlBasename": "1_79245_968169839ec0fa228966a376fa846fc1.jpg",
                    "currency": "SGD",
                    "price": "2.5",
                    "normalPrice": "2.5"
                },
                {
                    "id": 13,
                    "title": "Aloha Petey Kids Bananas (Philippines)",
                    "description": "Bananas help regulate blood sugar and can help relieve stress.",
                    "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_77846_050c4413edf15787b783bf90419a60d5.jpg",
                    "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_77846_050c4413edf15787b783bf90419a60d5.jpg",
                    "slug": "aloha-petey-kids-bananas-philippines",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "size": "200 g",
                    "status": "status_available",
                    "imageUrlBasename": "1_77846_050c4413edf15787b783bf90419a60d5.jpg",
                    "currency": "SGD",
                    "price": "2.65",
                    "normalPrice": "2.65"
                },
                {
                    "id": 10,
                    "title": "Apple Envy Large (USA)",
                    "description": null,
                    "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_79822_dee21a5f65d5f9e64f85307a9f1ff3bf.jpg",
                    "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_79822_dee21a5f65d5f9e64f85307a9f1ff3bf.jpg",
                    "slug": "apple-envy-large-usa",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "size": "each",
                    "status": "status_available",
                    "imageUrlBasename": "1_79822_dee21a5f65d5f9e64f85307a9f1ff3bf.jpg",
                    "currency": "SGD",
                    "price": "2.75",
                    "normalPrice": "2.75"
                },
                {
                    "id": 6262,
                    "title": "Thai Honey Bee Mango",
                    "description": null,
                    "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/000_default_product_photo.png",
                    "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/000_default_product_photo.png",
                    "slug": "thai-honey-bee-mango",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "size": "each",
                    "status": "status_available",
                    "imageUrlBasename": "000_default_product_photo.png",
                    "currency": "SGD",
                    "price": "2.9",
                    "normalPrice": "2.9"
                },
                {
                    "id": 6267,
                    "title": "Guava Malaysia",
                    "description": null,
                    "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/000_default_product_photo.png",
                    "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/000_default_product_photo.png",
                    "slug": "guava-malaysia",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "size": "each",
                    "status": "status_available",
                    "imageUrlBasename": "000_default_product_photo.png",
                    "currency": "SGD",
                    "price": "3.0",
                    "normalPrice": "3.0"
                },
                {
                    "id": 11,
                    "title": "Avocado, medium",
                    "description": "Avocados provide almost 20 essential nutrients, including fiber, potassium, Vitamin E and B-vitamins.",
                    "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_11241_c81ae9a4415bfa79c705965e4d6ce011.jpg",
                    "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_11241_c81ae9a4415bfa79c705965e4d6ce011.jpg",
                    "slug": "avocado-medium",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "size": null,
                    "status": "status_available",
                    "imageUrlBasename": "1_11241_c81ae9a4415bfa79c705965e4d6ce011.jpg",
                    "currency": "SGD",
                    "price": "3.05",
                    "normalPrice": "3.05"
                },
                {
                    "id": 2525,
                    "title": "Cold Storage Dried Prunes (USA)",
                    "description": null,
                    "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_78876_43498123401e9b9ddc4e0532990ec9c2.jpg",
                    "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_78876_43498123401e9b9ddc4e0532990ec9c2.jpg",
                    "slug": "cold-storage-dried-prunes-usa",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "size": "125 g",
                    "status": "status_available",
                    "imageUrlBasename": "1_78876_43498123401e9b9ddc4e0532990ec9c2.jpg",
                    "currency": "SGD",
                    "price": "3.2",
                    "normalPrice": "3.2"
                }
            ],
            "meta": {
                "current_page": 2,
                "total_pages": 6,
                "total_count": 58
            },
            "categories": [
                {
                    "id": 4,
                    "title": "Non-Leafy Vegetables",
                    "slug": "1-non-leafy-vegetables",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 88
                },
                {
                    "id": 2,
                    "title": "Fruits",
                    "slug": "1-fruits",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 58
                },
                {
                    "id": 3,
                    "title": "Leafy Vegetables",
                    "slug": "1-leafy-vegetables",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 47
                },
                {
                    "id": 1,
                    "title": "Beans, Nuts & Seeds",
                    "slug": "1-beans-nuts-seeds",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 29
                },
                {
                    "id": 10,
                    "title": "Tofu",
                    "slug": "1-tofu",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 22
                },
                {
                    "id": 6,
                    "title": "Herbs & Spices",
                    "slug": "1-herbs-spices",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 21
                },
                {
                    "id": 8,
                    "title": "Chilis",
                    "slug": "1-chilis",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 12
                },
                {
                    "id": 9,
                    "title": "Other Fruits & Vegetables",
                    "slug": "1-other-fruits-vegetables",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 12
                },
                {
                    "id": 7,
                    "title": "Mushrooms",
                    "slug": "1-mushrooms",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 11
                },
                {
                    "id": 5,
                    "title": "Gourds & Squashes",
                    "slug": "1-gourds-squashes",
                    "imageUrl": null,
                    "description": null,
                    "productsCount": 5
                }
            ]
        }

# Group Cart

## Cart Refresh [/api/carts/{cart_token}/refresh?access_token={access_token}&countryCode={countryCode}]
+ Parameters
    + cart_token (required, string, `f552f7bd-7c01-46ec-a9ec-5fade5918e26`) ... Cart token of the cart data that is to be refreshed
    + access_token (optional, string, `9de2d4b2d533eb225c95c9ade14d7e648e678f115358d71cdade56c908b1ba94`) ... Required for users, not required for guests
    + countryCode (optional, string, `SG`) ... Not required

### Cart Refresh [POST]
+ Response 200 (application/json; charset=utf-8)

        {
            "ok": true
        }

## Apply and Remove Credit Account v2 [/api/carts/{cartId}/coupon?accessToken={accessToken}&creditAccountId={creditAccountId}&countryCode={countryCode}]
API to calculate coupon disount/free delivery base on Firebase cart. if `additionalClientSideValidations` is not empty, additional client side validation is needed.

+ Parameters
    + cartId (required, string, `f552f7bd-7c01-46ec-a9ec-5fade5918e26`) ... Firebase cart token
    + countryCode (optional, string, `SG`) ... country code of the site, default to 'SG'
    + accessToken (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... User access token
    + creditAccountId (optional, number, `3`) ... required when applying coupon

### Apply Credit Account v2 [POST]
+ Request 200
    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

        {
            "id": 2,
            "firstPurchase": false,
            "creditAmount": 2,
            "currency": "SGD",
            "brands": {
                "brand-cart-2": {
                    "freeDeliveryAmount": "30"
                },
                "brand-cart-3": {
                    "freeDeliveryAmount": "30"
                },
                "brand-cart-4": {
                    "freeDeliveryAmount": "30"
                },
                "brand-cart-5": {
                    "freeDeliveryAmount": "30"
                },
                "brand-cart-6": {
                    "freeDeliveryAmount": "30"
                },
                "brand-cart-7": {
                    "freeDeliveryAmount": "30"
                },
                "brand-cart-8": {
                    "freeDeliveryAmount": "30"
                },
                "brand-cart-9": {
                    "freeDeliveryAmount": "30"
                }
            },
            "name": "$free delivery for two brands",
            "description": "spend $65 and receive discount"
        }

### Remove Credit Account v2 [DELETE]
+ Request 200
    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 204

## Calculate Coupon v2 [/api/carts/{id}/calculate?accessToken={accessToken}]
API to calculate coupon disount/free delivery base on Firebase cart. if `additionalClientSideValidations` is not empty, additional client side validation is needed.

+ Parameters
    + id (required, string, `f552f7bd-7c01-46ec-a9ec-5fade5918e26`) ... Firebase cart token
    + accessToken (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... User access token

### Calculate Coupon v2 [GET]
+ Request 200
    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "cart": {
                    "subtotal": 37.05,
                    "delivery": 0,
                    "concierge": 0,
                    "discount": 5,
                    "total": 32.05
                },
                "currency": "SGD",
                "brands": {
                    "2": {
                        "subtotal": 10.05,
                        "delivery": 0,
                        "concierge": 0,
                        "total": 10.05
                    },
                    "3": {
                        "subtotal": 27,
                        "delivery": 0,
                        "concierge": 0,
                        "total": 27
                    }
                },
                "couponError": "A minimum spend of $30 for each store is required use this coupon."
            }

    + Attributes
        + cart (object)
            + subtotal (number)
            + delivery (number)
            + concierge (number)
            + discount (number)
            + total (number)
        + currency (string)
        + brands (object) - Map
            + 2 (object) - Brand ID Key
                + subtotal (number)
                + delivery (number)
                + concierge (number)
                + total (number)
        + couponError (string) - If an error occurs
        + couponClientSideValidations (object) - If client side validation is required
            + cardPrefix: 123456 (string) - Issuer Identification Number (iin)

# Group Address

## Address [/api/addresses/{id}?access_token={access_token}]
A single Address object with all its details

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + id (required, number, `1`) ... The address id

### Retrieve an Address [GET]
If the given id doesn't exist, will return null

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "id": 3,
                "name": "Chris Temp Home",
                "addressType": null,
                "address1": "1101 W Barry Ave",
                "address2": null,
                "unit": "3E",
                "city": "Chicago",
                "state": "IL",
                "country": "US",
                "region": null,
                "postalCode": "60657",
                "latitude": null,
                "longitude": null,
                "notes": null,
                "building": null,
                "floor": null,
                "company": null
            }

### Remove an Address [DELETE]

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "status":
                {
                    "code": 200,
                    "message": "Address was deleted successfully"
                }
            }

## Addresses Collection [/api/addresses?access_token={access_token}]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token

### List of addresses [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 6,
                    "name": "Chris Temp Home",
                    "addressType": null,
                    "address1": "1101 W Barry Ave",
                    "address2": null,
                    "unit": "3E",
                    "city": "Chicago",
                    "state": "IL",
                    "country": "US",
                    "region": null,
                    "postalCode": "60657",
                    "latitude": null,
                    "longitude": null,
                    "notes": null,
                    "building": null,
                    "floor": null,
                    "company": null
                }
            ]

### Create an address [POST]

+ Request 200 (application/json)

    + Body

            {
                "address":
                    {
                        "name": "Twimm",
                        "addressType": "home",
                        "address1":"Zoozzy",
                        "address2": "Yotz",
                        "unit": 12,
                        "city": "Chengdu",
                        "state": "Sichuan",
                        "country": "sg",
                        "postalCode":"228396",
                        "building": 33,
                        "floor": 15,
                        "company": "Yotz"
                    }
            }

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "id": 8,
                "name": "Twimm",
                "addressType": "home",
                "address1": "Zoozzy",
                "address2": "Yotz",
                "unit": "12",
                "city": "Chengdu",
                "state": "Sichuan",
                "country": "sg",
                "region": null,
                "postalCode": "228396",
                "latitude": null,
                "longitude": null,
                "notes": null,
                "building": "33",
                "floor": "15",
                "company": "Yotz"
            }

# Group MapLocation

## MapLocation Collection [/api/map_locations/search?access_token={access_token}&countryCode={countryCode}&q={q}&limit={limit}]
Search form in-house maintained locations

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + q (required, string, `grand`) ... query keyword
    + countryCode (optional, string, `SG`) ... Country code
    + limit (optional, number, `2`) ... limit of responded result

### Search [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            [
              {
                "id": "123",
                "name": "Grand Hyatt Singapore",
                "address": "10 Scotts Road, Singapore 228211",
                "countryCode": "SG",
                "latitude": 1.3066814,
                "longitude": 103.8333942
              },
              {
                "id": "444",
                "name": "Grand Park Orchard",
                "address": "270 Orchard Rd, Singapore 238857",
                "countryCode": "SG",
                "latitude": 1.303313,
                "longitude": 103.8360148
              }
            ]

# Group Payment Device

## Add Payment Device Info [/api/cart/checkout/payment?access_token={access_token}]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token

### Create payment device info [POST]

+ Request 200 (application/json)

    + Body

            {
                "payment_device": {
                    "name": "DBS",
                    "status": 0,
                    "deviceType": 1
                }
            }

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "status": {
                    "code" : 200,
                    "message": "Payment device was created successfully"
                }
            }

## Payment Device Collection [/api/payment_devices?access_token={access_token}]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token

### Payment Device Collection [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 1,
                    "priority": 0,
                    "name": "Chris Fake Credit Card",
                    "externalDevCode": null,
                    "externalUserCode": null,
                    "expiration": null,
                    "accountMask": "1111",
                    "status": "verified",
                    "active": false,
                    "deviceType": "credit_card",
                    "deviceTypeName": "Visa",
                    "notes": null
                }
            ]

## Payment Device [/api/payment_devices/{id}?access_token={access_token}]
A single Payment Device object with all its details

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + id (required, number, `2`) ... The payment device id

### Retrieve a Payment Device [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "id": 1,
                "priority": 0,
                "name": "Chris Fake Credit Card",
                "externalDevCode": null,
                "externalUserCode": null,
                "expiration": null,
                "accountMask": "1111",
                "status": "verified",
                "active": false,
                "deviceType": "credit_card",
                "deviceTypeName": "Visa",
                "notes": null
            }

### Remove a Payment Device [DELETE]
+ Response 200

        {
            "status":
            {
                "code": 200,
                "message": "Credit card was deleted successfully"
            }
        }

# Group Checkout

## Get delivery timing for order [/api/checkout/delivery_timing?access_token={access_token}&addressId={addressId}&cartId={cartId}&zoneId={zoneId}&address1={address1}&address2={address2}&unit={unit}&city={city}&state={state}&postalCode={postalCode}&country={country}&addressType={addressType}&storeTotal2=0&storeTotal6=0&creditAccountId={creditAccountId}]

If the checkout is a user, the addressId should be passed into the API.

If the current user is a guest, then the address can be passed into the API.

Either an address with a postalCode OR an addressId should be required.

The API should validate the address against a service to make sure it's valid.

+ Parameters
    + access_token (optional, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + addressId (optional, number, `1`) ... The address id
    + cartId (required, string, `f552f7bd-7c01-46ec-a9ec-5fade5918e26`) ... The cart id
    <!-- Commented out because syntax is wrong -->
    <!-- + storeTotal{brandId} (required, number, `12`) ... The store total for a given storeId -->
    + zoneId (required, number, `1`) ... The zone id
    + address1 (optional, string, `123 Park Ave`) ... The address field.
    + address2 (optional, string, `Freshman Dorm`) ... The second address field.
    + city (optional, string, `Stanford`) ... The city
    + state (optional, string, `CA`) ... The state
    + postalCode (optional, string, `94309`) ... The postal code
    + country (optional, string, `US`) ... The country code
    + unit (optional, string, ``) ... The unit
    + addressType (optional, string, `other`) ... The type of address, within other, home, business
    + creditAccountId (optional, number, `23`) ... Current credit account id, coupon which user wants to apply

### Get delivery timing list [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 6,
                    "name": "Sheng Siong",
                    "minimumOrderFreeDelivery": "80.0",
                    "freeDeliveryLeftAmount": "63",
                    "days": [
                        {
                            "day": "2015-03-25T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 1700,
                                    "status": "available",
                                    "startDate": "2015-03-25T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1701,
                                    "status": "available",
                                    "startDate": "2015-03-25T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1702,
                                    "status": "available",
                                    "startDate": "2015-03-25T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1703,
                                    "status": "available",
                                    "startDate": "2015-03-25T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1704,
                                    "status": "available",
                                    "startDate": "2015-03-25T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1705,
                                    "status": "available",
                                    "startDate": "2015-03-25T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-03-26T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 1706,
                                    "status": "available",
                                    "startDate": "2015-03-26T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1707,
                                    "status": "available",
                                    "startDate": "2015-03-26T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1708,
                                    "status": "available",
                                    "startDate": "2015-03-26T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1709,
                                    "status": "available",
                                    "startDate": "2015-03-26T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1710,
                                    "status": "available",
                                    "startDate": "2015-03-26T05:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1711,
                                    "status": "available",
                                    "startDate": "2015-03-26T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1712,
                                    "status": "available",
                                    "startDate": "2015-03-26T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1713,
                                    "status": "available",
                                    "startDate": "2015-03-26T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1714,
                                    "status": "available",
                                    "startDate": "2015-03-26T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1715,
                                    "status": "available",
                                    "startDate": "2015-03-26T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1716,
                                    "status": "available",
                                    "startDate": "2015-03-26T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-03-27T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 1717,
                                    "status": "available",
                                    "startDate": "2015-03-27T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1718,
                                    "status": "available",
                                    "startDate": "2015-03-27T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1719,
                                    "status": "available",
                                    "startDate": "2015-03-27T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1720,
                                    "status": "available",
                                    "startDate": "2015-03-27T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1721,
                                    "status": "available",
                                    "startDate": "2015-03-27T05:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1722,
                                    "status": "available",
                                    "startDate": "2015-03-27T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1723,
                                    "status": "available",
                                    "startDate": "2015-03-27T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1724,
                                    "status": "available",
                                    "startDate": "2015-03-27T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1725,
                                    "status": "available",
                                    "startDate": "2015-03-27T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1726,
                                    "status": "available",
                                    "startDate": "2015-03-27T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1727,
                                    "status": "available",
                                    "startDate": "2015-03-27T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-03-28T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 1728,
                                    "status": "available",
                                    "startDate": "2015-03-28T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1729,
                                    "status": "available",
                                    "startDate": "2015-03-28T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1730,
                                    "status": "available",
                                    "startDate": "2015-03-28T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1731,
                                    "status": "available",
                                    "startDate": "2015-03-28T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1732,
                                    "status": "available",
                                    "startDate": "2015-03-28T05:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1733,
                                    "status": "available",
                                    "startDate": "2015-03-28T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1734,
                                    "status": "available",
                                    "startDate": "2015-03-28T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1735,
                                    "status": "available",
                                    "startDate": "2015-03-28T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1736,
                                    "status": "available",
                                    "startDate": "2015-03-28T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1737,
                                    "status": "available",
                                    "startDate": "2015-03-28T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1738,
                                    "status": "available",
                                    "startDate": "2015-03-28T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-03-29T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 1739,
                                    "status": "available",
                                    "startDate": "2015-03-29T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1740,
                                    "status": "available",
                                    "startDate": "2015-03-29T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1741,
                                    "status": "available",
                                    "startDate": "2015-03-29T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1742,
                                    "status": "available",
                                    "startDate": "2015-03-29T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1743,
                                    "status": "available",
                                    "startDate": "2015-03-29T05:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1744,
                                    "status": "available",
                                    "startDate": "2015-03-29T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1745,
                                    "status": "available",
                                    "startDate": "2015-03-29T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1746,
                                    "status": "available",
                                    "startDate": "2015-03-29T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1747,
                                    "status": "available",
                                    "startDate": "2015-03-29T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1748,
                                    "status": "available",
                                    "startDate": "2015-03-29T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1749,
                                    "status": "available",
                                    "startDate": "2015-03-29T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-03-30T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 1750,
                                    "status": "available",
                                    "startDate": "2015-03-30T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1751,
                                    "status": "available",
                                    "startDate": "2015-03-30T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1752,
                                    "status": "available",
                                    "startDate": "2015-03-30T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1753,
                                    "status": "available",
                                    "startDate": "2015-03-30T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1754,
                                    "status": "available",
                                    "startDate": "2015-03-30T05:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1755,
                                    "status": "available",
                                    "startDate": "2015-03-30T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1756,
                                    "status": "available",
                                    "startDate": "2015-03-30T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1757,
                                    "status": "available",
                                    "startDate": "2015-03-30T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1758,
                                    "status": "available",
                                    "startDate": "2015-03-30T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1759,
                                    "status": "available",
                                    "startDate": "2015-03-30T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1760,
                                    "status": "available",
                                    "startDate": "2015-03-30T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-03-31T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 1761,
                                    "status": "available",
                                    "startDate": "2015-03-31T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1762,
                                    "status": "available",
                                    "startDate": "2015-03-31T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1763,
                                    "status": "available",
                                    "startDate": "2015-03-31T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1764,
                                    "status": "available",
                                    "startDate": "2015-03-31T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1765,
                                    "status": "available",
                                    "startDate": "2015-03-31T05:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1766,
                                    "status": "available",
                                    "startDate": "2015-03-31T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1767,
                                    "status": "available",
                                    "startDate": "2015-03-31T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1768,
                                    "status": "available",
                                    "startDate": "2015-03-31T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1769,
                                    "status": "available",
                                    "startDate": "2015-03-31T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1770,
                                    "status": "available",
                                    "startDate": "2015-03-31T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1771,
                                    "status": "available",
                                    "startDate": "2015-03-31T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-04-01T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 1772,
                                    "status": "available",
                                    "startDate": "2015-04-01T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1773,
                                    "status": "available",
                                    "startDate": "2015-04-01T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1774,
                                    "status": "available",
                                    "startDate": "2015-04-01T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1775,
                                    "status": "available",
                                    "startDate": "2015-04-01T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 1776,
                                    "status": "available",
                                    "startDate": "2015-04-01T05:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        }
                    ]
                },
                {
                    "id": 2,
                    "name": "Cold Storage",
                    "minimumOrderFreeDelivery": "80.0",
                    "days": [
                        {
                            "day": "2015-03-25T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 468,
                                    "status": "available",
                                    "startDate": "2015-03-25T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 469,
                                    "status": "available",
                                    "startDate": "2015-03-25T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 470,
                                    "status": "available",
                                    "startDate": "2015-03-25T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 471,
                                    "status": "available",
                                    "startDate": "2015-03-25T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 472,
                                    "status": "available",
                                    "startDate": "2015-03-25T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 473,
                                    "status": "available",
                                    "startDate": "2015-03-25T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-03-26T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 474,
                                    "status": "available",
                                    "startDate": "2015-03-26T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 475,
                                    "status": "available",
                                    "startDate": "2015-03-26T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 476,
                                    "status": "available",
                                    "startDate": "2015-03-26T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 477,
                                    "status": "available",
                                    "startDate": "2015-03-26T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 478,
                                    "status": "available",
                                    "startDate": "2015-03-26T05:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 479,
                                    "status": "available",
                                    "startDate": "2015-03-26T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 480,
                                    "status": "available",
                                    "startDate": "2015-03-26T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 481,
                                    "status": "available",
                                    "startDate": "2015-03-26T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 482,
                                    "status": "available",
                                    "startDate": "2015-03-26T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 483,
                                    "status": "available",
                                    "startDate": "2015-03-26T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 484,
                                    "status": "available",
                                    "startDate": "2015-03-26T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-03-27T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 485,
                                    "status": "available",
                                    "startDate": "2015-03-27T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 486,
                                    "status": "available",
                                    "startDate": "2015-03-27T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 487,
                                    "status": "available",
                                    "startDate": "2015-03-27T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 488,
                                    "status": "available",
                                    "startDate": "2015-03-27T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 489,
                                    "status": "available",
                                    "startDate": "2015-03-27T05:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 490,
                                    "status": "available",
                                    "startDate": "2015-03-27T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 491,
                                    "status": "available",
                                    "startDate": "2015-03-27T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 492,
                                    "status": "available",
                                    "startDate": "2015-03-27T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 493,
                                    "status": "available",
                                    "startDate": "2015-03-27T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 494,
                                    "status": "available",
                                    "startDate": "2015-03-27T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 495,
                                    "status": "available",
                                    "startDate": "2015-03-27T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-03-28T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 496,
                                    "status": "available",
                                    "startDate": "2015-03-28T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 497,
                                    "status": "available",
                                    "startDate": "2015-03-28T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 498,
                                    "status": "available",
                                    "startDate": "2015-03-28T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 499,
                                    "status": "available",
                                    "startDate": "2015-03-28T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 500,
                                    "status": "available",
                                    "startDate": "2015-03-28T05:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 501,
                                    "status": "available",
                                    "startDate": "2015-03-28T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 502,
                                    "status": "available",
                                    "startDate": "2015-03-28T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 503,
                                    "status": "available",
                                    "startDate": "2015-03-28T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 504,
                                    "status": "available",
                                    "startDate": "2015-03-28T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 505,
                                    "status": "available",
                                    "startDate": "2015-03-28T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 506,
                                    "status": "available",
                                    "startDate": "2015-03-28T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-03-29T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 507,
                                    "status": "available",
                                    "startDate": "2015-03-29T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 508,
                                    "status": "available",
                                    "startDate": "2015-03-29T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 509,
                                    "status": "available",
                                    "startDate": "2015-03-29T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 510,
                                    "status": "available",
                                    "startDate": "2015-03-29T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 511,
                                    "status": "available",
                                    "startDate": "2015-03-29T05:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 512,
                                    "status": "available",
                                    "startDate": "2015-03-29T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 513,
                                    "status": "available",
                                    "startDate": "2015-03-29T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 514,
                                    "status": "available",
                                    "startDate": "2015-03-29T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 515,
                                    "status": "available",
                                    "startDate": "2015-03-29T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 516,
                                    "status": "available",
                                    "startDate": "2015-03-29T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 517,
                                    "status": "available",
                                    "startDate": "2015-03-29T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-03-30T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 518,
                                    "status": "available",
                                    "startDate": "2015-03-30T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 519,
                                    "status": "available",
                                    "startDate": "2015-03-30T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 520,
                                    "status": "available",
                                    "startDate": "2015-03-30T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 521,
                                    "status": "available",
                                    "startDate": "2015-03-30T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 522,
                                    "status": "available",
                                    "startDate": "2015-03-30T05:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 523,
                                    "status": "available",
                                    "startDate": "2015-03-30T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 524,
                                    "status": "available",
                                    "startDate": "2015-03-30T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 525,
                                    "status": "available",
                                    "startDate": "2015-03-30T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 526,
                                    "status": "available",
                                    "startDate": "2015-03-30T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 527,
                                    "status": "available",
                                    "startDate": "2015-03-30T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 528,
                                    "status": "available",
                                    "startDate": "2015-03-30T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-03-31T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 529,
                                    "status": "available",
                                    "startDate": "2015-03-31T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 530,
                                    "status": "available",
                                    "startDate": "2015-03-31T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 531,
                                    "status": "available",
                                    "startDate": "2015-03-31T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 532,
                                    "status": "available",
                                    "startDate": "2015-03-31T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 533,
                                    "status": "available",
                                    "startDate": "2015-03-31T05:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 534,
                                    "status": "available",
                                    "startDate": "2015-03-31T06:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 535,
                                    "status": "available",
                                    "startDate": "2015-03-31T07:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 536,
                                    "status": "available",
                                    "startDate": "2015-03-31T08:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 537,
                                    "status": "available",
                                    "startDate": "2015-03-31T09:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 538,
                                    "status": "available",
                                    "startDate": "2015-03-31T10:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 539,
                                    "status": "available",
                                    "startDate": "2015-03-31T11:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        },
                        {
                            "day": "2015-04-01T00:00:00.000+08:00",
                            "times": [
                                {
                                    "id": 540,
                                    "status": "available",
                                    "startDate": "2015-04-01T01:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 541,
                                    "status": "available",
                                    "startDate": "2015-04-01T02:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 542,
                                    "status": "available",
                                    "startDate": "2015-04-01T03:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 543,
                                    "status": "available",
                                    "startDate": "2015-04-01T04:00:00.000Z",
                                    "fee": "10.0"
                                },
                                {
                                    "id": 544,
                                    "status": "available",
                                    "startDate": "2015-04-01T05:00:00.000Z",
                                    "fee": "10.0"
                                }
                            ]
                        }
                    ]
                }
            ]

# Group Order

## Order [/api/orders/{id}?access_token={access_token}&fields={fields}]
A single Order object with all its details

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + id (required, string, `1`) ... The order id or the order_guid
    + fields (required, string, `order_item_count,order_fulfillments,order_items,payment_transactions`) ... Extra fields

### Retrieve an Order [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "id": 1,
                "orderGuid": "d863f0de-395a-41d3-8507-65ac88e5d11d",
                "orderNumber": "1000",
                "status": "delivered",
                "totalAmount": "521.2",
                "paymentCompletedDate": "2015-01-01T00:00:00.000+08:00",
                "brandList": "Cold Storage",
                "subtotalAmount": "521.2",
                "shippingAmount": "0.0",
                "serviceAmount": "0.0",
                "taxAmount": "0.0",
                "paymentMethod": "credit_card",
                "paymentDeviceId": 1,
                "shippingTrackingNumber": "ABC123",
                "deliveredDate": "2015-01-02T00:00:00.000+08:00",
                "requiresShipping": true,
                "userId": 1,
                "customerNotes": null,
                "adminNotes": null,
                "deliveryNotes": null,
                "customData": null,
                "discountAmount": null,
                "replacementPreference": "no_replacements_desired",
                "shippingAddress": {
                    "id": 1,
                    "name": "Chris Temp Home",
                    "addressType": "home",
                    "address1": "1101 W Barry Ave",
                    "address2": null,
                    "unit": "3E",
                    "city": "Chicago",
                    "state": "IL",
                    "country": "US",
                    "region": null,
                    "postalCode": "60657",
                    "latitude": null,
                    "longitude": null,
                    "notes": null,
                    "building": null,
                    "floor": null,
                    "company": null
                },
                "orderItemCount": 10,
                "orderFulfillments": [
                    {
                        "id": 1,
                        "trackingNumber": null,
                        "estimatedDeliveryDate": null,
                        "deliveredDate": null,
                        "deliveryTimeslot": null,
                        "fulfillmentType": null,
                        "fulfillmentStatus": null
                    }
                ],
                "orderItems": [
                    {
                        "id": 1,
                        "sku": null,
                        "quantity": 3,
                        "amount": "1.9",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 7877,
                            "title": "Leaf Lime 50G",
                            "description": null,
                            "imageUrl": "https://instamart.s3.amazonaws.com/cs2_sm/55569.jpg",
                            "previewImageUrl": "https://instamart.s3.amazonaws.com/cs2_sm/55569.jpg",
                            "price": "1.9",
                            "slug": "55569-leaf-lime-50-g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "245G",
                            "status":"status_available",
                            "imageUrlBasename": "55569.jpg"
                        }
                    },
                    {
                        "id": 2,
                        "sku": null,
                        "quantity": 2,
                        "amount": "2.55",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 883,
                            "title": "ALOHA Banana Cavendish Philippines ~ 1KG 1KG",
                            "description": null,
                            "imageUrl": "https://instamart.s3.amazonaws.com/cs2_sm/73588.jpg",
                            "previewImageUrl": "https://instamart.s3.amazonaws.com/cs2_sm/73588.jpg",
                            "price": "2.55",
                            "slug": "73588-aloha-banana-philippines",
                            "barcode": null,
                            "unitType": "unitTypeGrams",
                            "soldBy": "soldByWeight",
                            "amountPerUnit": "250.0",
                            "normalPrice": null,
                            "size": "245G",
                            "status":"status_available",
                            "imageUrlBasename": "73588.jpg"
                        }
                    }
                ],
                "paymentTransactions": [
                    {
                        "transactionDate": "2015-03-11T10:30:22.403+08:00",
                        "grossAmount": "521.2",
                        "netAmount": "521.2",
                        "notes": null,
                        "paymentDevice": {
                            "id": 1,
                            "priority": 0,
                            "name": "Chris Fake Credit Card",
                            "externalDevCode": null,
                            "externalUserCode": null,
                            "expiration": null,
                            "accountMask": "1111",
                            "status": "verified",
                            "active": true,
                            "deviceType": "credit_card",
                            "deviceTypeName": "Visa",
                            "notes": null
                        }
                    }
                ],
                "paymentDevice": {
                    "id": 1,
                    "priority": 0,
                    "name": "Chris Fake Credit Card",
                    "externalDevCode": null,
                    "externalUserCode": null,
                    "expiration": null,
                    "accountMask": "1111",
                    "status": "verified",
                    "active": true,
                    "deviceType": "credit_card",
                    "deviceTypeName": "Visa",
                    "notes": null
                }
            }

## Orders Collection [/api/orders?access_token={access_token}&fields={fields}]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + fields (required, string, `order_item_count,order_fulfillments,order_items,payment_transactions`) ... Extra fields

### List all orders [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body


            [
                {
                    "id": 2,
                    "orderGuid": "569532f2-6637-427b-83df-b955a8924872",
                    "orderNumber": 1001,
                    "status": "delivered",
                    "totalAmount": "189.4",
                    "paymentCompletedDate": "2015-02-01T00:00:00.000+08:00",
                    "brandList": ["Cold Storage", "Fair Price"],
                    "createdAt": "2015-04-15T07:52:15.086+08:00",
                    "replacementPreference": "call_to_confirm_replacements",
                    "orderItemCount": 10,
                    "orderFulfillments": [{
                        "id": 2,
                        "trackingNumber": "124",
                        "estimatedDeliveryDate": "2015-01-03T13:40:00.000+08:00",
                        "deliveredDate": null,
                        "deliveryTimeslot": {
                            "id": 2,
                            "timeslot": {
                                "startDate": "2015-04-14T10:00:00.000+08:00",
                                "endDate": "2015-04-14T11:00:00.000+08:00"
                            }
                        },
                        "fulfillmentType": "worker",
                        "fulfillmentStatus": "fulfillment_requested_assignment"
                    }, {
                        "id": 3,
                        "trackingNumber": "125",
                        "estimatedDeliveryDate": "2015-01-03T13:40:00.000+08:00",
                        "deliveredDate": null,
                        "deliveryTimeslot": {
                            "id": 693,
                            "timeslot": {
                                "startDate": "2015-04-20T19:00:00.000+08:00",
                                "endDate": "2015-04-20T20:00:00.000+08:00"
                            }
                        },
                        "fulfillmentType": "worker",
                        "fulfillmentStatus": "fulfillment_requested_assignment"
                    }],
                    "orderItems": [{
                        "id": 11,
                        "sku": null,
                        "quantity": 3,
                        "amount": "5.45",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98874,
                            "title": "Masterfoods Garlic Pepper Seasoning",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59707_15317633de3037473d06993c8b392513.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59707_15317633de3037473d06993c8b392513.jpg",
                            "price": "5.45",
                            "slug": "masterfoods-garlic-pepper-seasoning-50g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "50G",
                            "status": "status_available",
                            "imageUrlBasename": "1_59707_15317633de3037473d06993c8b392513.jpg"
                        }
                    }, {
                        "id": 12,
                        "sku": null,
                        "quantity": 5,
                        "amount": "6.0",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98875,
                            "title": "Masterfoods Garlic Powder",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_121558_b4764b4b93bd80cb0c57685e53d55166.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_121558_b4764b4b93bd80cb0c57685e53d55166.jpg",
                            "price": "6.0",
                            "slug": "masterfoods-garlic-powder-50g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "50G",
                            "status": "status_available",
                            "imageUrlBasename": "1_121558_b4764b4b93bd80cb0c57685e53d55166.jpg"
                        }
                    }, {
                        "id": 13,
                        "sku": null,
                        "quantity": 3,
                        "amount": "3.6",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98876,
                            "title": "Masterfoods Garlic Salt",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59706_7643b41045075bbf960b748e61305ddd.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59706_7643b41045075bbf960b748e61305ddd.jpg",
                            "price": "3.6",
                            "slug": "masterfoods-garlic-salt-70g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "70G",
                            "status": "status_available",
                            "imageUrlBasename": "1_59706_7643b41045075bbf960b748e61305ddd.jpg"
                        }
                    }, {
                        "id": 14,
                        "sku": null,
                        "quantity": 4,
                        "amount": "4.6",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98877,
                            "title": "Masterfoods Ginger Ground",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59711_9b1844d52fa07d59cb3baec6cbafc635.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59711_9b1844d52fa07d59cb3baec6cbafc635.jpg",
                            "price": "4.6",
                            "slug": "masterfoods-ginger-ground-25g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "25G",
                            "status": "status_available",
                            "imageUrlBasename": "1_59711_9b1844d52fa07d59cb3baec6cbafc635.jpg"
                        }
                    }, {
                        "id": 15,
                        "sku": null,
                        "quantity": 1,
                        "amount": "4.1",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98878,
                            "title": "Masterfoods Italian Herbs",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59712_f40c4fb0e854d3b9ec2f3e6f8e038864.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59712_f40c4fb0e854d3b9ec2f3e6f8e038864.jpg",
                            "price": "4.1",
                            "slug": "masterfoods-italian-herbs-10g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "10G",
                            "status": "status_available",
                            "imageUrlBasename": "1_59712_f40c4fb0e854d3b9ec2f3e6f8e038864.jpg"
                        }
                    }, {
                        "id": 16,
                        "sku": null,
                        "quantity": 5,
                        "amount": "4.65",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98879,
                            "title": "Masterfoods Lemon Pepper Seasoning",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_49436_44086ab8bb14a98482e179764d6538cb.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_49436_44086ab8bb14a98482e179764d6538cb.jpg",
                            "price": "4.65",
                            "slug": "masterfoods-lemon-pepper-seasoning-52g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "52G",
                            "status": "status_available",
                            "imageUrlBasename": "1_49436_44086ab8bb14a98482e179764d6538cb.jpg"
                        }
                    }, {
                        "id": 17,
                        "sku": null,
                        "quantity": 5,
                        "amount": "4.95",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98880,
                            "title": "Masterfoods Mint Jelly",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_49463_34c785e9cc32eb78718bc6b65e5fba05.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_49463_34c785e9cc32eb78718bc6b65e5fba05.jpg",
                            "price": "4.95",
                            "slug": "masterfoods-mint-jelly-290g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "290G",
                            "status": "status_available",
                            "imageUrlBasename": "1_49463_34c785e9cc32eb78718bc6b65e5fba05.jpg"
                        }
                    }, {
                        "id": 18,
                        "sku": null,
                        "quantity": 5,
                        "amount": "4.0",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98881,
                            "title": "Masterfoods Mixed Herbs",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_49438_a57cebf06808e15038f512573a57e60f.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_49438_a57cebf06808e15038f512573a57e60f.jpg",
                            "price": "4.0",
                            "slug": "masterfoods-mixed-herbs-10g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "10G",
                            "status": "status_available",
                            "imageUrlBasename": "1_49438_a57cebf06808e15038f512573a57e60f.jpg"
                        }
                    }, {
                        "id": 19,
                        "sku": null,
                        "quantity": 5,
                        "amount": "6.95",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98882,
                            "title": "Masterfoods Nutmeg Ground",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_120483_c32d022f9acf1506281078210d7a752e.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_120483_c32d022f9acf1506281078210d7a752e.jpg",
                            "price": "6.95",
                            "slug": "masterfoods-nutmeg-ground-30g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "30G",
                            "status": "status_available",
                            "imageUrlBasename": "1_120483_c32d022f9acf1506281078210d7a752e.jpg"
                        }
                    }, {
                        "id": 20,
                        "sku": null,
                        "quantity": 2,
                        "amount": "3.5",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98883,
                            "title": "Masterfoods Oregano Leaves",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_120482_88e7dafba5155e91dd07c3deb4ab7b76.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_120482_88e7dafba5155e91dd07c3deb4ab7b76.jpg",
                            "price": "3.5",
                            "slug": "masterfoods-oregano-leaves-5g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "5G",
                            "status": "status_available",
                            "imageUrlBasename": "1_120482_88e7dafba5155e91dd07c3deb4ab7b76.jpg"
                        }
                    }],
                    "paymentTransactions": [{
                        "transactionDate": "2015-04-15T07:52:15.129+08:00",
                        "grossAmount": "189.4",
                        "netAmount": "189.4",
                        "notes": null,
                        "paymentDevice": {
                            "id": 1,
                            "priority": 0,
                            "name": "Chris Fake Credit Card",
                            "externalDevCode": "123",
                            "externalUserCode": null,
                            "expiration": null,
                            "accountMask": "1111",
                            "status": "verified",
                            "active": true,
                            "deviceType": "credit_card",
                            "deviceTypeName": "Visa",
                            "notes": null
                        }
                    }]
                }, {
                    "id": 1,
                    "orderGuid": "b6c29ebe-f675-4fed-83b9-a1b193932c52",
                    "orderNumber": 1000,
                    "status": "gathering",
                    "totalAmount": "129.2",
                    "paymentCompletedDate": "2015-01-01T00:00:00.000+08:00",
                    "brandList": ["Cold Storage"],
                    "createdAt": "2015-04-15T07:52:14.888+08:00",
                    "replacementPreference": "no_replacements_desired",
                    "orderItemCount": 10,
                    "orderFulfillments": [{
                        "id": 1,
                        "trackingNumber": "123",
                        "estimatedDeliveryDate": "2015-01-02T13:40:00.000+08:00",
                        "deliveredDate": null,
                        "deliveryTimeslot": {
                            "id": 1,
                            "timeslot": {
                                "startDate": "2015-04-14T09:00:00.000+08:00",
                                "endDate": "2015-04-14T10:00:00.000+08:00"
                            }
                        },
                        "fulfillmentType": "worker",
                        "fulfillmentStatus": "fulfillment_assigned"
                    }],
                    "orderItems": [{
                        "id": 1,
                        "sku": null,
                        "quantity": 1,
                        "amount": "4.95",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98863,
                            "title": "Masterfoods Cinnamon Ground",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_49431_faee9d538ed3d0eba4564a002ec5a814.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_49431_faee9d538ed3d0eba4564a002ec5a814.jpg",
                            "price": "4.95",
                            "slug": "masterfoods-cinnamon-ground-28g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "28G",
                            "status": "status_available",
                            "imageUrlBasename": "1_49431_faee9d538ed3d0eba4564a002ec5a814.jpg"
                        }
                    }, {
                        "id": 2,
                        "sku": null,
                        "quantity": 3,
                        "amount": "4.5",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98864,
                            "title": "Masterfoods Cinnamon Sugar",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_121554_bf236e44d1fb3d009ee3643e342d51fb.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_121554_bf236e44d1fb3d009ee3643e342d51fb.jpg",
                            "price": "4.5",
                            "slug": "masterfoods-cinnamon-sugar-55g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "55G",
                            "status": "status_available",
                            "imageUrlBasename": "1_121554_bf236e44d1fb3d009ee3643e342d51fb.jpg"
                        }
                    }, {
                        "id": 3,
                        "sku": null,
                        "quantity": 2,
                        "amount": "8.3",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98865,
                            "title": "Masterfoods Cloves Ground",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59647_c74d642be7e3f4c783772beb005cbeb5.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59647_c74d642be7e3f4c783772beb005cbeb5.jpg",
                            "price": "8.3",
                            "slug": "masterfoods-cloves-ground-26g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "26G",
                            "status": "status_available",
                            "imageUrlBasename": "1_59647_c74d642be7e3f4c783772beb005cbeb5.jpg"
                        }
                    }, {
                        "id": 4,
                        "sku": null,
                        "quantity": 3,
                        "amount": "8.0",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98866,
                            "title": "Masterfoods Cloves Whole",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_60366_6f86e2a7854b801cb89b8cfed8539e86.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_60366_6f86e2a7854b801cb89b8cfed8539e86.jpg",
                            "price": "8.0",
                            "slug": "masterfoods-cloves-whole-20g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "20G",
                            "status": "status_available",
                            "imageUrlBasename": "1_60366_6f86e2a7854b801cb89b8cfed8539e86.jpg"
                        }
                    }, {
                        "id": 5,
                        "sku": null,
                        "quantity": 2,
                        "amount": "4.7",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98867,
                            "title": "Masterfoods Coriander Leaves",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_60369_061b0d0b82a28d5504dce6bddf2e9ddc.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_60369_061b0d0b82a28d5504dce6bddf2e9ddc.jpg",
                            "price": "4.7",
                            "slug": "masterfoods-coriander-leaves-5g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "5G",
                            "status": "status_available",
                            "imageUrlBasename": "1_60369_061b0d0b82a28d5504dce6bddf2e9ddc.jpg"
                        }
                    }, {
                        "id": 6,
                        "sku": null,
                        "quantity": 2,
                        "amount": "4.0",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98868,
                            "title": "Masterfoods Coriander Seeds Ground",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_120490_656faacd6fa60b9a746b4436909aa3a9.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_120490_656faacd6fa60b9a746b4436909aa3a9.jpg",
                            "price": "4.0",
                            "slug": "masterfoods-coriander-seeds-ground-25g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "25G",
                            "status": "status_available",
                            "imageUrlBasename": "1_120490_656faacd6fa60b9a746b4436909aa3a9.jpg"
                        }
                    }, {
                        "id": 7,
                        "sku": null,
                        "quantity": 2,
                        "amount": "5.7",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98869,
                            "title": "Masterfoods Cumin Seeds Ground",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_120489_be65590862177ffa6e6d5c48efd742bc.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_120489_be65590862177ffa6e6d5c48efd742bc.jpg",
                            "price": "5.7",
                            "slug": "masterfoods-cumin-seeds-ground-25g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "25G",
                            "status": "status_available",
                            "imageUrlBasename": "1_120489_be65590862177ffa6e6d5c48efd742bc.jpg"
                        }
                    }, {
                        "id": 8,
                        "sku": null,
                        "quantity": 3,
                        "amount": "6.0",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98870,
                            "title": "Masterfoods Dill Leaf Tips",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_120488_19c627dc3725f864049be1591a792568.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_120488_19c627dc3725f864049be1591a792568.jpg",
                            "price": "6.0",
                            "slug": "masterfoods-dill-leaf-tips-10g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "10G",
                            "status": "status_available",
                            "imageUrlBasename": "1_120488_19c627dc3725f864049be1591a792568.jpg"
                        }
                    }, {
                        "id": 9,
                        "sku": null,
                        "quantity": 4,
                        "amount": "4.35",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98871,
                            "title": "Masterfoods Fine Wholegrain Mustard",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59696_c9a35f13766e9397a5543003ddfd8796.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59696_c9a35f13766e9397a5543003ddfd8796.jpg",
                            "price": "4.35",
                            "slug": "masterfoods-fine-wholegrain-mustard-250g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "250G",
                            "status": "status_out_of_stock",
                            "imageUrlBasename": "1_59696_c9a35f13766e9397a5543003ddfd8796.jpg"
                        }
                    }, {
                        "id": 10,
                        "sku": null,
                        "quantity": 1,
                        "amount": "5.95",
                        "taxAmount": "0.0",
                        "customerNotes": null,
                        "product": {
                            "id": 98872,
                            "title": "Masterfoods Garam Masala",
                            "description": null,
                            "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59710_504be7775b31304e4f6db1312c9e8ff5.jpg",
                            "previewImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_59710_504be7775b31304e4f6db1312c9e8ff5.jpg",
                            "price": "5.95",
                            "slug": "masterfoods-garam-masala-30g",
                            "barcode": null,
                            "unitType": "unit_type_item",
                            "soldBy": "sold_by_item",
                            "amountPerUnit": "1.0",
                            "normalPrice": null,
                            "size": "30G",
                            "status": "status_available",
                            "imageUrlBasename": "1_59710_504be7775b31304e4f6db1312c9e8ff5.jpg"
                        }
                    }],
                    "paymentTransactions": [{
                        "transactionDate": "2015-04-15T07:52:15.066+08:00",
                        "grossAmount": "129.2",
                        "netAmount": "129.2",
                        "notes": null,
                        "paymentDevice": {
                            "id": 1,
                            "priority": 0,
                            "name": "Chris Fake Credit Card",
                            "externalDevCode": "123",
                            "externalUserCode": null,
                            "expiration": null,
                            "accountMask": "1111",
                            "status": "verified",
                            "active": true,
                            "deviceType": "credit_card",
                            "deviceTypeName": "Visa",
                            "notes": null
                        }
                    }]
                }
            ]

## Get summary for order [/api/orders/{orderId}/summary?access_token={access_token}]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + orderId (required, number, `1`) ... The order id

### Get Order Summary [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "orderSummary":"251.35"
            }

## Get order details from order guid for analytics tracking [/api/orders/{orderGuid}/tracking]

+ Parameters
    + orderGuid (required, string, `d863f0de-395a-41d3-8507-65ac88e5d11d`) ... The order guid

### Get Order Details for Analytics [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "id": "12",
                "totalAmount": "55.12",
                "email": "jonathan@honestbee.com",
                "firstPurchase": false,
                "isGuest": false
            }

## Get order status timeline [/api/orders/{orderId}/versions]
Get status timeline of an order

+ Parameters
    + orderId (required, number, `1`) ... The order id

### Get Order Status Timeline [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "statusTimeline": [
                    {
                        "status": "fulfillment_processing",
                        "orderFulfillmentId": 1,
                        "brandName": "Cold Storage",
                        "timestamp": "2016-04-30T10:31:42.895+08:00"
                    }
                ]
            }

## Reorder an order [/api/orders/{orderId}/reorder?access_token={access_token}]
Return a messsage of unordered products (If there are any).

Ex:  {"message": "Sorry, these products are unavailable: ..."}

Otherwise, return { "ok": true }

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + orderId (required, number, `1`) ... The order id

### Reorder an order [POST]

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "ok": true
            }

# Group Order Item

## Order items Collection [/api/orders/{orderId}/order_items?access_token={access_token}]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + orderId (required, number, `1`) ... The order id

### List all Order Items [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 18,
                    "sku": null,
                    "quantity": 5,
                    "amount": "5.5",
                    "taxAmount": "0.0",
                    "customerNotes": null,
                    "product": {
                        "id": 13860,
                        "title": "Laughing Cow Mini Babybel 5 P",
                        "description": null,
                        "imageUrl": "https://instamart.s3.amazonaws.com/cs_sm/392074.jpg",
                        "previewImageUrl": "https://instamart.s3.amazonaws.com/cs_sm/392074.jpg",
                        "price": "5.5",
                        "slug": "laughing-cow-mini-babybel-5-p",
                        "barcode": null,
                        "unitType": "unit_type_item",
                        "soldBy": "sold_by_item",
                        "amountPerUnit": "1.0",
                        "normalPrice": "5.5",
                        "size": "245G",
                        "status":"status_available",
                        "imageUrlBasename": "392074.jpg"
                    }
                },
                {
                    "id": 19,
                    "sku": null,
                    "quantity": 4,
                    "amount": "5.4",
                    "taxAmount": "0.0",
                    "customerNotes": null,
                    "product": {
                        "id": 13864,
                        "title": "Mini Babybel Swiss Cheese",
                        "description": null,
                        "imageUrl": "https://instamart.s3.amazonaws.com/cs_sm/031485.jpg",
                        "previewImageUrl": "https://instamart.s3.amazonaws.com/cs_sm/031485.jpg",
                        "price": "5.4",
                        "slug": "mini-babybel-swiss-cheese",
                        "barcode": null,
                        "unitType": "unit_type_item",
                        "soldBy": "sold_by_item",
                        "amountPerUnit": "1.0",
                        "normalPrice": "5.4",
                        "size": "245G",
                        "status":"status_available",
                        "imageUrlBasename": "031485.jpg"
                    }
                }
            ]

## Reorder an order item [/api/orders/{orderId}/order_items/{orderItemId}/reorder?access_token={access_token}]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + orderId (required, number, `1`) ... The order id
    + orderItemId (required, number, `1`) ... The order item id

### Reorder an order item [POST]

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "ok": true
            }

## Reorder an order item substitute [/api/orders/{orderId}/order_items/{orderItemId}/reorder_substitute?access_token={access_token}]
This api allows user to reorder the substitute item if an order item is fulfilled by replacement and not custom replacement

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + orderId (required, number, `1`) ... The order id
    + orderItemId (required, number, `6`) ... The order item id

### Reorder an order item substitute [POST]

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "ok": true
            }

# Group Catalog

## Catalogs Collection [/api/catalogs?access_token={access_token}]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token

### List all Catalog Items [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                  "id": 2,
                  "brandId": 2,
                  "name": "Cold Storage"
                },
                {
                  "id": 3,
                  "brandId": 3,
                  "name": "Fair Price"
                }
            ]

# Group Order Fulfillment

## Order Fulfillment [/api/order_fulfillments/{id}?access_token={access_token}&role={role}&status={status}]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + id (required, number, `3`) ... The order fulfillment id
    + role (required, string, `shopper`) ... The role of this order
    + status (optional, string, ``) ... the status to filter by.  If unspecified, all fulfillments for the role and user are returned.

### Retrieve an Order Fulfillment [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "id": 3,
                "trackingNumber": "125",
                "estimatedDeliveryDate": "2015-01-03T13:40:00.000+08:00",
                "deliveredDate": null,
                "deliveryTimeslot": {
                    "id": 693,
                    "timeslot": {
                        "startDate": "2015-04-20T19:00:00.000+08:00",
                        "endDate": "2015-04-20T20:00:00.000+08:00"
                    }
                },
                "fulfillmentType": "worker",
                "fulfillmentStatus": "fulfillment_requested_assignment",
                "specialTreatmentTags": null,
                "orderItemsCount": 0,
                "fulfilledItemsCount": 0,
                "replacedItemsCount": 0,
                "adjustmentAmount": "0",
                "conciergeFee": null,
                "delivererStatus": "deliverer_pending_acceptance",
                "shopperStatus": "shopper_pending_acceptance",
                "delivererNotifiedAt": null,
                "shopperNotifiedAt": null,
                "notesToShopper": "The deliverer will be late",
                "notesToDeliverer": "The shopper will be late",
                "pickupNotes": "Please meet at the MRT",
                "pickupLatitude": "1.302",
                "pickupLongitude": "103.4",
                "pickupTime": null,
                "order": {
                    "id": 2,
                    "orderGuid": "487eddd3-89bb-4a33-b021-f77fbb42791b",
                    "orderNumber": 1001,
                    "contactPhoneNumber": null,
                    "status": "delivered",
                    "totalAmount": "154.0",
                    "paymentCompletedDate": "2015-02-01T00:00:00.000+08:00",
                    "shippingTrackingNumber": "DEF456",
                    "deliveredDate": "2015-02-02T00:00:00.000+08:00",
                    "discountAmount": null,
                    "user": {
                        "id": 1,
                        "email": "chris@honestbee.com",
                        "name": "Chris Wang",
                        "mobileNumber": "44444444",
                        "imageUrl": "https://lifeopp.blob.core.windows.net/entity/243731_141015090457_192.jpg"
                    },
                    "customerNotes": null,
                    "requiresShipping": true,
                    "shippingAddress": {
                        "id": 1,
                        "name": "Monstro Mart",
                        "addressType": "home",
                        "address1": "Brickson Park",
                        "address2": null,
                        "unit": "9",
                        "city": null,
                        "state": null,
                        "country": "Mauritius",
                        "region": null,
                        "postalCode": "13566-6890",
                        "latitude": null,
                        "longitude": null,
                        "notes": null,
                        "building": "10",
                        "floor": "6",
                        "company": "Tavu"
                    },
                    "replacementPreference": "call_to_confirm_replacements",
                    "country": {
                        "id": 1,
                        "countryCode": "SG"
                    }
                },
                "shopper": {
                    "id": 1,
                    "email": "chris@honestbee.com",
                    "name": "Chris Wang",
                    "mobileNumber": "44444444",
                    "imageUrl": "https://lifeopp.blob.core.windows.net/entity/243731_141015090457_192.jpg"
                },
                "coordinator": {
                    "id": 3,
                    "email": "jonathan@honestbee.com",
                    "name": "Jonathan Low",
                    "mobileNumber": "44444444",
                    "imageUrl": "https://lifeopp.blob.core.windows.net/entity/243731_141015090457_192.jpg"
                },
                "deliverer": {
                    "id": 2,
                    "email": "grace@honestbee.com",
                    "name": "Grace Zhang",
                    "mobileNumber": "33333333",
                    "imageUrl": "https://devlifeopp.blob.core.windows.net/entity/18170_141016093502_192.jpg"
                },
                "store": {
                    "id": 3,
                    "name": "Fair Price",
                    "slug": "fair-price",
                    "brandId": 3,
                    "addressId": 3,
                    "catalogId": 3,
                    "priority": null,
                    "notes": "",
                    "description": "",
                    "imageUrl": "fair-price.png",
                    "brand": {
                        "id": 3,
                        "name": "Fair Price",
                        "slug": "fair-price",
                        "description": null,
                        "imageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/fair-price.jpg",
                        "minimumOrderFreeDelivery": "80.0",
                        "defaultDeliveryFee": "10.0"
                    },
                    "address": {
                        "id": 3,
                        "name": "Twimm",
                        "addressType": "home",
                        "address1": "Zoozzy",
                        "address2": "Yotz",
                        "unit": "12",
                        "city": "Chengdu",
                        "state": "Sichuan",
                        "country": "sg",
                        "region": null,
                        "postalCode": "228396",
                        "latitude": null,
                        "longitude": null,
                        "notes": null,
                        "building": "33",
                        "floor": "15",
                        "company": "Yotz"
                    }
                },
                "orderItems": []
            }

## Order Fulfillments For Order [/api/orders/{id}/order_fulfillments/?access_token={access_token}]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + id (required, number, `1`) ... The order id

### Retrieve an Order Fulfillment [GET]

+ Response 200 (application/json; charset=utf-8)

    + Body


            [
                {
                    "id": 1,
                    "trackingNumber": "123",
                    "estimatedDeliveryDate": "2015-01-02T13:40:00.000+08:00",
                    "deliveredDate": null,
                    "deliveryTimeslot": {
                        "id": 1,
                        "timeslot": {
                            "startDate": "2015-04-14T09:00:00.000+08:00",
                            "endDate": "2015-04-14T10:00:00.000+08:00"
                        }
                    },
                    "fulfillmentType": "worker",
                    "fulfillmentStatus": "fulfillment_assigned",
                    "brandName": "Cold Storage",
                    "brandSlug": "cold-storage",
                    "brandImageUrl": "https://s3-ap-southeast-1.amazonaws.com/honestbees-development/banners/images/360x120/cold-storage.jpg"
                }
            ]

## Order Fulfillment Status [/api/order_fulfillments/{id}/status?access_token={access_token}]

+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + id (required, number, `1`) ... The order fulfillment id

### Update a fulfillment status [POST]

The following table describes the parameters in the request:

<table>
    <thead>
        <tr>
            <th>Parameter</th>
            <th>Required?</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Role</td>
            <td>Yes</td>
            <td>The role for the user's response.  Values: "shopper", "deliverer"</td>
        </tr>
        <tr>
            <td>Status Action</td>
            <td>Yes</td>
            <td>The action to post for the status.  Values: "accept", "reject", "start", "complete", "handed_over"</td>
        </tr>
        <tr>
            <td>Latitude</td>
            <td>No</td>
            <td></td>
        </tr>
        <tr>
            <td>Longitude</td>
            <td>No</td>
            <td></td>
        </tr>
    </tbody>
</table>

+ Request 200 (application/json)

    + Body

            {
                "role": "shopper",
                "statusAction": "accept",
                "latitude": 1.3000,
                "longitude": 103.8000
            }

    + Schema

            {
                "type": "object",
                "properties": {
                    "role": {
                        "type": "string",
                        "required": true,
                        "description": "Used to specify what role the user is responding as",
                        "suggestedValues": [
                            "shopper",
                            "deliverer"
                        ]
                    },
                    "statusAction": {
                        "type": "string",
                        "required": true,
                        "description": "The action to post to update the status",
                        "suggestedValues": [
                            "accept",
                            "reject",
                            "start",
                            "complete"
                        ]
                    },
                    "latitude": {
                        "type": "decimal",
                        "required": false
                    },
                    "longitude": {
                        "type": "decimal",
                        "required": false
                    }
                }
            }

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "id": 1,
                "trackingNumber": "123",
                "estimatedDeliveryDate": "2015-01-02T13:40:00.000+08:00",
                "deliveredDate": null,
                "deliveryTimeslot": {
                    "id": 1,
                    "timeslot": {
                        "startDate": "2015-01-15T09:00:00.000+08:00",
                        "endDate": "2015-01-15T10:00:00.000+08:00"
                    }
                },
                "fulfillmentType": "worker",
                "fulfillmentStatus": "fulfillment_assigned",
                "specialTreatmentTags": null,
                "orderItemsCount": 0,
                "fulfilledItemsCount": 0,
                "replacedItemsCount": 0,
                "adjustmentAmount": "0",
                "conciergeFee": null,
                "delivererStatus": "deliverer_unassigned",
                "shopperStatus": "shopper_accepted",
                "store": {
                    "id": 2,
                    "name": "Cold Storage",
                    "slug": "Cold Storage",
                    "brandId": 2,
                    "addressId": 2,
                    "catalogId": 2,
                    "priority": null,
                    "notes": null,
                    "description": null,
                    "imageUrl": null,
                    "brand": {
                        "id": 2,
                        "name": "Cold Storage",
                        "slug": "cold-storage",
                        "description": null,
                        "imageUrl": null
                    },
                    "address": {
                        "id": 2,
                        "name": "Cold Storage - GWC",
                        "addressType": "business",
                        "address1": "1 Kim Seng Promenade",
                        "address2": "Great World City",
                        "unit": "B1-18/19",
                        "city": "Singapore",
                        "state": "Singapore",
                        "country": "SG",
                        "region": null,
                        "postalCode": "237994",
                        "latitude": null,
                        "longitude": null,
                        "notes": null,
                        "building": null,
                        "floor": null,
                        "company": null
                    }
                },
                "order": {
                    "id": 1,
                    "orderGuid": "cf77084c-9a00-467f-b7b8-e87c8966a60a",
                    "orderNumber": "1000",
                    "contactPhoneNumber": null,
                    "status": "delivered",
                    "totalAmount": "534.0",
                    "paymentCompletedDate": "2015-01-01T00:00:00.000+08:00",
                    "shippingTrackingNumber": "ABC123",
                    "deliveredDate": "2015-01-02T00:00:00.000+08:00",
                    "discountAmount": null,
                    "user": {
                        "id": 1,
                        "email": "chris@honestbee.com",
                        "name": "Chris Wang",
                        "mobileNumber": "11111111",
                        "imageUrl": "https://lifeopp.blob.core.windows.net/entity/10002_131016053326_192.jpg"
                    },
                    "customerNotes": null,
                    "requiresShipping": true,
                    "shippingAddress": {
                        "id": 1,
                        "name": "Chris Temp Home",
                        "addressType": "home",
                        "address1": "1101 W Barry Ave",
                        "address2": null,
                        "unit": "3E",
                        "city": "Chicago",
                        "state": "IL",
                        "country": "US",
                        "region": null,
                        "postalCode": "60657",
                        "latitude": null,
                        "longitude": null,
                        "notes": null,
                        "building": null,
                        "floor": null,
                        "company": null
                    }
                },
                "shopper": {
                    "id": 1,
                    "email": "chris@honestbee.com",
                    "name": "Chris Wang",
                    "mobileNumber": "11111111",
                    "imageUrl": "https://lifeopp.blob.core.windows.net/entity/10002_131016053326_192.jpg"
                },
                "coordinator": {
                    "id": 4,
                    "email": "jonathan@lifeopp.com",
                    "name": "Jonathan Low",
                    "mobileNumber": "44444444",
                    "imageUrl": "https://lifeopp.blob.core.windows.net/entity/243731_141015090457_192.jpg"
                },
                "deliverer": {
                    "id": 3,
                    "email": "grace@lifeopp.io",
                    "name": "Grace Zhang",
                    "mobileNumber": "33333333",
                    "imageUrl": "https://devlifeopp.blob.core.windows.net/entity/18170_141016093502_192.jpg"
                }
            }

## My Order Fulfillments Collection [/api/order_fulfillments?access_token={access_token}&role={role}&status={status}&page={page}]
+ Parameters
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token
    + role (required, string, `shopper`)
    + status (optional, string, ``) ... the status to filter by.  If unspecified, all fulfillments for the role and user are returned.
    + page (optional, integer, `1`) ... The page

### List all Order Fulfillments [GET]

<table>
    <thead>
        <tr>
            <th>Parameter</th>
            <th>Required?</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Access Token</td>
            <td>Yes</td>
            <td></td>
        </tr>
        <tr>
            <td>Role</td>
            <td>Yes</td>
            <td>The role for the user's response.  Values: "shopper", "deliverer"
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td>No</td>
            <td>The status to filter by.  Values: unassigned, pending_acceptance, pending_start, started, completed</td>
        </tr>
        <tr>
            <td>Page</td>
            <td>No</td>
            <td></td>
        </tr>
    </tbody>
</table>


+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "id": 1,
                    "trackingNumber": "123",
                    "estimatedDeliveryDate": "2015-01-02T13:40:00.000+08:00",
                    "deliveredDate": null,
                    "deliveryTimeslot": {
                        "id": 1,
                        "timeslot": {
                            "startDate": "2015-01-15T09:00:00.000+08:00",
                            "endDate": "2015-01-15T10:00:00.000+08:00"
                        }
                    },
                    "fulfillmentType": "worker",
                    "fulfillmentStatus": "fulfillment_requested_assignment",
                    "specialTreatmentTags": null,
                    "orderItemsCount": 0,
                    "fulfilledItemsCount": 0,
                    "replacedItemsCount": 0,
                    "adjustmentAmount": "0",
                    "conciergeFee": null,
                    "delivererStatus": "deliverer_pending_acceptance",
                    "shopperStatus": "shopper_pending_acceptance",
                    "notesToShopper": "Please fulfill quickly, the customer is a VIP",
                    "notesToDeliverer": "Please deliverer quickly, the customer is a VIP",
                    "pickupNotes": "Please meet at the corner",
                    "pickupTime": "2015-01-03T13:30:00.000+08:00",
                    "pickupLatitude": "1.3",
                    "pickupLongitude": "103.7",
                    "store": {
                        "id": 2,
                        "name": "Cold Storage",
                        "slug": "Cold Storage",
                        "brandId": 2,
                        "addressId": 2,
                        "catalogId": 2,
                        "priority": null,
                        "notes": null,
                        "description": null,
                        "imageUrl": null,
                        "brand": {
                            "id": 2,
                            "name": "Cold Storage",
                            "slug": "cold-storage",
                            "description": null,
                            "imageUrl": null
                        },
                        "address": {
                            "id": 2,
                            "name": "Cold Storage - GWC",
                            "addressType": "business",
                            "address1": "1 Kim Seng Promenade",
                            "address2": "Great World City",
                            "unit": "B1-18/19",
                            "city": "Singapore",
                            "state": "Singapore",
                            "country": "SG",
                            "region": null,
                            "postalCode": "237994",
                            "latitude": null,
                            "longitude": null,
                            "notes": null,
                            "building": null,
                            "floor": null,
                            "company": null
                        }
                    },
                    "order": {
                        "id": 1,
                        "orderGuid": "cf77084c-9a00-467f-b7b8-e87c8966a60a",
                        "orderNumber": "1000",
                        "contactPhoneNumber": null,
                        "status": "delivered",
                        "totalAmount": "534.0",
                        "paymentCompletedDate": "2015-01-01T00:00:00.000+08:00",
                        "shippingTrackingNumber": "ABC123",
                        "deliveredDate": "2015-01-02T00:00:00.000+08:00",
                        "discountAmount": null,
                        "user": {
                            "id": 1,
                            "email": "chris@honestbee.com",
                            "name": "Chris Wang",
                            "mobileNumber": "11111111",
                            "imageUrl": "https://lifeopp.blob.core.windows.net/entity/10002_131016053326_192.jpg"
                        },
                        "customerNotes": null,
                        "requiresShipping": true,
                        "shippingAddress": {
                            "id": 1,
                            "name": "Chris Temp Home",
                            "addressType": "home",
                            "address1": "1101 W Barry Ave",
                            "address2": null,
                            "unit": "3E",
                            "city": "Chicago",
                            "state": "IL",
                            "country": "US",
                            "region": null,
                            "postalCode": "60657",
                            "latitude": null,
                            "longitude": null,
                            "notes": null,
                            "building": null,
                            "floor": null,
                            "company": null
                        }
                    },
                    "shopper": {
                        "id": 1,
                        "email": "chris@honestbee.com",
                        "name": "Chris Wang",
                        "mobileNumber": "11111111",
                        "imageUrl": "https://lifeopp.blob.core.windows.net/entity/10002_131016053326_192.jpg"
                    },
                    "coordinator": {
                        "id": 4,
                        "email": "jonathan@lifeopp.com",
                        "name": "Jonathan Low",
                        "mobileNumber": "44444444",
                        "imageUrl": "https://lifeopp.blob.core.windows.net/entity/243731_141015090457_192.jpg"
                    },
                    "deliverer": {
                        "id": 3,
                        "email": "grace@lifeopp.io",
                        "name": "Grace Zhang",
                        "mobileNumber": "33333333",
                        "imageUrl": "https://devlifeopp.blob.core.windows.net/entity/18170_141016093502_192.jpg"
                    }
                }, {
                    "id": 2,
                    "trackingNumber": "124",
                    "estimatedDeliveryDate": "2015-01-03T13:40:00.000+08:00",
                    "deliveredDate": null,
                    "deliveryTimeslot": {
                        "id": 2,
                        "timeslot": {
                            "startDate": "2015-01-15T10:00:00.000+08:00",
                            "endDate": "2015-01-15T11:00:00.000+08:00"
                        }
                    },
                    "fulfillmentType": "worker",
                    "fulfillmentStatus": "fulfillment_requested_assignment",
                    "specialTreatmentTags": null,
                    "orderItemsCount": 0,
                    "fulfilledItemsCount": 0,
                    "replacedItemsCount": 0,
                    "adjustmentAmount": "0",
                    "conciergeFee": null,
                    "delivererStatus": "deliverer_pending_acceptance",
                    "shopperStatus": "shopper_pending_acceptance",
                    "notesToShopper": "The deliverer will be early",
                    "notesToDeliverer": "The shopper will be early",
                    "pickupNotes": "Please meet at the street",
                    "pickupTime": "2015-01-03T13:30:00.000+08:00",
                    "pickupLatitude": "1.301",
                    "pickupLongitude": "103.71",
                    "store": {
                        "id": 2,
                        "name": "Cold Storage",
                        "slug": "Cold Storage",
                        "brandId": 2,
                        "addressId": 2,
                        "catalogId": 2,
                        "priority": null,
                        "notes": null,
                        "description": null,
                        "imageUrl": null,
                        "brand": {
                            "id": 2,
                            "name": "Cold Storage",
                            "slug": "cold-storage",
                            "description": null,
                            "imageUrl": null
                        },
                        "address": {
                            "id": 2,
                            "name": "Cold Storage - GWC",
                            "addressType": "business",
                            "address1": "1 Kim Seng Promenade",
                            "address2": "Great World City",
                            "unit": "B1-18/19",
                            "city": "Singapore",
                            "state": "Singapore",
                            "country": "SG",
                            "region": null,
                            "postalCode": "237994",
                            "latitude": null,
                            "longitude": null,
                            "notes": null,
                            "building": null,
                            "floor": null,
                            "company": null
                        }
                    },
                    "order": {
                        "id": 2,
                        "orderGuid": "adb13ebb-2473-4267-9550-05b6687d4a59",
                        "orderNumber": "1001",
                        "contactPhoneNumber": null,
                        "status": "delivered",
                        "totalAmount": "374.65",
                        "paymentCompletedDate": "2015-02-01T00:00:00.000+08:00",
                        "shippingTrackingNumber": "DEF456",
                        "deliveredDate": "2015-02-02T00:00:00.000+08:00",
                        "discountAmount": null,
                        "user": {
                            "id": 1,
                            "email": "chris@honestbee.com",
                            "name": "Chris Wang",
                            "mobileNumber": "11111111",
                            "imageUrl": "https://lifeopp.blob.core.windows.net/entity/10002_131016053326_192.jpg"
                        },
                        "customerNotes": null,
                        "requiresShipping": true,
                        "shippingAddress": {
                            "id": 1,
                            "name": "Chris Temp Home",
                            "addressType": "home",
                            "address1": "1101 W Barry Ave",
                            "address2": null,
                            "unit": "3E",
                            "city": "Chicago",
                            "state": "IL",
                            "country": "US",
                            "region": null,
                            "postalCode": "60657",
                            "latitude": null,
                            "longitude": null,
                            "notes": null,
                            "building": null,
                            "floor": null,
                            "company": null
                        }
                    },
                    "shopper": {
                        "id": 1,
                        "email": "chris@honestbee.com",
                        "name": "Chris Wang",
                        "mobileNumber": "11111111",
                        "imageUrl": "https://lifeopp.blob.core.windows.net/entity/10002_131016053326_192.jpg"
                    },
                    "coordinator": {
                        "id": 4,
                        "email": "jonathan@lifeopp.com",
                        "name": "Jonathan Low",
                        "mobileNumber": "44444444",
                        "imageUrl": "https://lifeopp.blob.core.windows.net/entity/243731_141015090457_192.jpg"
                    },
                    "deliverer": {
                        "id": 3,
                        "email": "grace@lifeopp.io",
                        "name": "Grace Zhang",
                        "mobileNumber": "33333333",
                        "imageUrl": "https://devlifeopp.blob.core.windows.net/entity/18170_141016093502_192.jpg"
                    }
                }, {
                    "id": 3,
                    "trackingNumber": "125",
                    "estimatedDeliveryDate": "2015-01-03T13:40:00.000+08:00",
                    "deliveredDate": null,
                    "deliveryTimeslot": {
                        "id": 924,
                        "timeslot": {
                            "startDate": "2015-01-28T19:00:00.000+08:00",
                            "endDate": "2015-01-28T20:00:00.000+08:00"
                        }
                    },
                    "fulfillmentType": "worker",
                    "fulfillmentStatus": "fulfillment_requested_assignment",
                    "specialTreatmentTags": null,
                    "orderItemsCount": 0,
                    "fulfilledItemsCount": 0,
                    "replacedItemsCount": 0,
                    "adjustmentAmount": "0",
                    "conciergeFee": null,
                    "delivererStatus": "deliverer_pending_acceptance",
                    "shopperStatus": "shopper_pending_acceptance",
                    "notesToShopper": "The deliverer will be late",
                    "notesToDeliverer": "The shopper will be late",
                    "pickupNotes": "Please meet at the MRT",
                    "pickupTime": "2015-01-03T13:30:00.000+08:00",
                    "pickupLatitude": "1.302",
                    "pickupLongitude": "103.4",
                    "store": {
                        "id": 3,
                        "name": "Fair Price",
                        "slug": "Fair Price",
                        "brandId": 3,
                        "addressId": 3,
                        "catalogId": 3,
                        "priority": null,
                        "notes": null,
                        "description": null,
                        "imageUrl": null,
                        "brand": {
                            "id": 3,
                            "name": "Fair Price",
                            "slug": "fair-price",
                            "description": null,
                            "imageUrl": null
                        },
                        "address": {
                            "id": 3,
                            "name": "Fair Price - Orchard Grand Court",
                            "addressType": "home",
                            "address1": "131 Killiney Road",
                            "address2": "Orchard Grand Court",
                            "unit": "01-01/02/03",
                            "city": "Singapore",
                            "state": "IL",
                            "country": "SG",
                            "region": null,
                            "postalCode": "239571",
                            "latitude": null,
                            "longitude": null,
                            "notes": null,
                            "building": null,
                            "floor": null,
                            "company": null
                        }
                    },
                    "order": {
                        "id": 2,
                        "orderGuid": "adb13ebb-2473-4267-9550-05b6687d4a59",
                        "orderNumber": "1001",
                        "contactPhoneNumber": null,
                        "status": "delivered",
                        "totalAmount": "374.65",
                        "paymentCompletedDate": "2015-02-01T00:00:00.000+08:00",
                        "shippingTrackingNumber": "DEF456",
                        "deliveredDate": "2015-02-02T00:00:00.000+08:00",
                        "discountAmount": null,
                        "user": {
                            "id": 1,
                            "email": "chris@honestbee.com",
                            "name": "Chris Wang",
                            "mobileNumber": "11111111",
                            "imageUrl": "https://lifeopp.blob.core.windows.net/entity/10002_131016053326_192.jpg"
                        },
                        "customerNotes": null,
                        "requiresShipping": true,
                        "shippingAddress": {
                            "id": 1,
                            "name": "Chris Temp Home",
                            "addressType": "home",
                            "address1": "1101 W Barry Ave",
                            "address2": null,
                            "unit": "3E",
                            "city": "Chicago",
                            "state": "IL",
                            "country": "US",
                            "region": null,
                            "postalCode": "60657",
                            "latitude": null,
                            "longitude": null,
                            "notes": null,
                            "building": null,
                            "floor": null,
                            "company": null
                        }
                    },
                    "shopper": {
                        "id": 1,
                        "email": "chris@honestbee.com",
                        "name": "Chris Wang",
                        "mobileNumber": "11111111",
                        "imageUrl": "https://lifeopp.blob.core.windows.net/entity/10002_131016053326_192.jpg"
                    },
                    "coordinator": {
                        "id": 4,
                        "email": "jonathan@lifeopp.com",
                        "name": "Jonathan Low",
                        "mobileNumber": "44444444",
                        "imageUrl": "https://lifeopp.blob.core.windows.net/entity/243731_141015090457_192.jpg"
                    },
                    "deliverer": {
                        "id": 3,
                        "email": "grace@lifeopp.io",
                        "name": "Grace Zhang",
                        "mobileNumber": "33333333",
                        "imageUrl": "https://devlifeopp.blob.core.windows.net/entity/18170_141016093502_192.jpg"
                    }
                }
            ]

# Group Search

## Search Suggestions [/api/search/suggestions?q={q}&brand={brand}&zone={zone}&categoryLimit={categoryLimit}&productLimit={productLimit}&departmentLimit={departmentLimit}]
The brand can be the id or slug

+ Parameters
    + q (required, string, `milk`) ... The search text
    + brand (optional, string, `2`) ... The brand id or slug, the value can be 1 or 'sheng-siong'
    + zone (optional, number, `1`) ... The zone id
    + categoryLimit (optional, number, `2`) ... Number of categories to retrieve
    + productLimit (optional, number, `2`) ... Number of products to retrieve
    + departmentLimit (optional, number, `2`) ... Number of departments to retrieve

### Get Search Suggestions [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "products": [
                    {
                        "id":99170,
                        "title":"First Choice Coconut Milk",
                        "slug":"first-choice-coconut-milk-400ml",
                        "price":"1.8",
                        "imageUrl":"https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_140287_3abce64658e223434829265fc2e25bd3.jpg",
                        "size":"400ML"
                    },
                    {
                        "id":99179,
                        "title":"Ayam Brand Trim Coconut Milk",
                        "slug":"ayam-brand-trim-coconut-milk-200ml",
                        "price":"0.95",
                        "imageUrl":"https://s3-ap-southeast-1.amazonaws.com/honestbees-development/products/images/480/1_23421_6a252fb0c918223adbba60c6defd91f2.jpg",
                        "size":"200ML"
                    }
                ],
                "categories":
                [
                    {
                        "id":5779,
                        "title":"Fresh Milk",
                        "description":null,
                        "departmentId":619,
                        "departmentName":"Dairy, Eggs \u0026 Deli",
                        "slug":"619-fresh-milk"
                    },
                    {
                        "id":5780,
                        "title":"Cultured Milk",
                        "description":null,
                        "departmentId":619,
                        "departmentName":"Dairy, Eggs \u0026 Deli",
                        "slug":"619-cultured-milk"
                    }
                ],
                "departments": [
                    {
                        "id": 5,
                        "name": "Rice & Noodles",
                        "description": null,
                        "imageUrl": "/rice-noodles.jpg"
                    }
                ]
            }

## Search Replacements [/api/search/replacements?q={q}&productId={productId}&storeId={storeId}&productLimit={productLimit}]
The brand can be the id or slug

+ Parameters
    + q (required, string, `Large Chicken`) ... The search text
    + productId (required, number, `2`) ... The id of user ordered product
    + storeId (required, number, `2`) ... The store id
    + productLimit (optional, number, `2`) ... Number of products to retrieve

### Get Search Replacements [GET]
+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "products": [
                    {
                        "id":258,
                        "title":"Large Chicken, Halal",
                        "slug":"large-chicken-halal",
                        "price":"9.05",
                        "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_74307_7da462918b42a3b37c6b3bec62d64ced.jpg",
                        "size": "~ 1.75 kg"
                    },
                    {
                        "id":252,
                        "title":"Capon Chicken",
                        "slug":"capon-chicken",
                        "price":"11.75",
                        "imageUrl":"https://honestbees.s3.amazonaws.com/products/images/480/1_219001_2e1608e9fb6c6697ab28c214ebf9c544.jpg",
                        "size": "~ 1.5 kg"
                    }
                ]
            }

## Search Autocomplete v2 [/api/stores/{id}/autocomplete?q={q}&categoryLimit={categoryLimit}&productLimit={productLimit}&departmentLimit={departmentLimit}]
Autocomplete API for search bar.

+ Parameters
    + id (required, string, `2`) ... Store id
    + q (required, string, `seed`) ... The search text
    + categoryLimit (optional, number, `2`) ... Number of categories to retrieve
    + productLimit (optional, number, `2`) ... Number of products to retrieve
    + departmentLimit (optional, number, `2`) ... Number of departments to retrieve

### Search Autocomplete v2 [GET]
+ Request 200

    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

        {
            "products": [
                {
                    "id": 1217,
                    "title": "Mestemacher Sunflower Seed Bread",
                    "description": null,
                    "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_731052_391507e4611ffa60fc56c26680618e2b.jpg",
                    "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_731052_391507e4611ffa60fc56c26680618e2b.jpg",
                    "slug": "mestemacher-sunflower-seed-bread",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "size": "500 g",
                    "status": "status_available",
                    "imageUrlBasename": "1_731052_391507e4611ffa60fc56c26680618e2b.jpg",
                    "currency": "SGD",
                    "price": "5.15",
                    "normalPrice": "5.15"
                },
                {
                    "id": 3095,
                    "title": "Crab Fennel Seeds",
                    "description": null,
                    "imageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_48385_e9c11199091a217698553385a6af1698.jpg",
                    "previewImageUrl": "https://honestbees.s3.amazonaws.com/products/images/480/1_48385_e9c11199091a217698553385a6af1698.jpg",
                    "slug": "crab-fennel-seeds",
                    "barcode": null,
                    "unitType": "unit_type_item",
                    "soldBy": "sold_by_item",
                    "amountPerUnit": "1.0",
                    "size": "30 g",
                    "status": "status_available",
                    "imageUrlBasename": "1_48385_e9c11199091a217698553385a6af1698.jpg",
                    "currency": "SGD",
                    "price": "1.6",
                    "normalPrice": "1.6"
                }
            ],
            "categories": [
                {
                    "id": 1,
                    "title": "Beans, Nuts & Seeds",
                    "slug": "1-beans-nuts-seeds",
                    "imageUrl": null,
                    "description": null,
                    "departmentId": 1,
                    "departmentName": "Fruits & Vegetables"
                },
                {
                    "id": 49,
                    "title": "Beans, Nuts & Seeds",
                    "slug": "5-beans-nuts-seeds",
                    "imageUrl": null,
                    "description": null,
                    "departmentId": 5,
                    "departmentName": "Rice & Noodles"
                }
            ],
            "departments": []
        }

# Group Coupon


## Get default coupon [/api/credit_types/default?countryCode={countryCode}]
+ Parameters
    + countryCode: SG (required, string) - Country code

### Get default credit type [GET]
+ Response 200 (application/json; charset=utf-8)

        {
                "name": "$free delivery for two brands",
                "description": "spend $65 and receive discount",
                "rules": {
                        "default": true,
                        "firstPurchase": true,
                        "currency": "SGD",
                        "order": {
                                "discountAmount": "12",
                                "minSpending": "65"
                        }
                }
        }


## Redeem Promotion Code [/api/redeemed_promotion_codes?code={code}&access_token={access_token}]
+ Parameters
    + code (required, string, `hbpromo`) ... The promotion code's code
    + access_token (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... The user access token

### Redeem Promotion Code [POST]
+ Response 200 (application/json; charset=utf-8)
    + Body

            {
                  "redeemed_promotion_code": {
                        "id":577,
                        "promotion_code_id":147,
                        "user_id":585,
                        "created_at":"2016-02-18T01:11:45.321+08:00",
                        "updated_at":"2016-02-18T01:11:45.321+08:00"
                  },
                  "credit_accounts": [
                        {
                              "id":1884,
                              "credit_type_id":108,
                              "user_id":585,
                              "credit_amount":"0.0",
                              "expiration_date":"2016-08-18T23:59:59.999+08:00",
                              "created_at":"2016-02-18T01:11:45.329+08:00",
                              "updated_at":"2016-02-18T01:11:45.329+08:00"
                        }
                  ],
                  "ok":true
            }

## Credit Accounts [/api/credit_accounts?access_token={access_token}&countryCode={countryCode}]
+ Parameters
    + access_token: 66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6 (required, string) - User access token
    + countryCode: SG (required, string) - Country code

### Get Credit Accounts [GET]
+ Response 200 (application/json; charset=utf-8)

        [
            {
                "id": 2,
                "coupon": {
                    "id": 2,
                    "firstPurchase": false,
                    "creditAmount": 2,
                    "currency": "SGD",
                    "brands": {
                        "brand-cart-2": {
                            "freeDeliveryAmount": "30"
                        },
                        "brand-cart-3": {
                            "freeDeliveryAmount": "30"
                        },
                        "brand-cart-4": {
                            "freeDeliveryAmount": "30"
                        },
                        "brand-cart-5": {
                            "freeDeliveryAmount": "30"
                        },
                        "brand-cart-6": {
                            "freeDeliveryAmount": "30"
                        },
                        "brand-cart-7": {
                            "freeDeliveryAmount": "30"
                        },
                        "brand-cart-8": {
                            "freeDeliveryAmount": "30"
                        },
                        "brand-cart-9": {
                            "freeDeliveryAmount": "30"
                        }
                    }
                },
                "creditType": {
                    "name": "$free delivery for two brands",
                    "description": "spend $65 and receive discount"
                }
            }
        ]

# Group API Versioning

## Mobile Version Check [/api/mobile/version?app_type={appType}&os={os}]
To check the minimum version of the app that will be supported by the default API.

+ Parameters
    + appType (required, string, `consumer_sg`) ... The application whose version is to be checked
    + os (required, string, `ios`) ... The operating system

### Get Mobile Version [GET]
+ Response 200 (application/json; charset=utf-8)
    + Body

            {
                "app_type": "consumer_sg",
                "os": "ios",
                "version": "1.0.0",
                "latest_version": "3.2.1"
            }

# Group Home

## Banners v2 [/api/banners?countryCode={countryCode}]
API for curated home banners

| `actionType` | Description | `actionValue` | `actionValue` Example |
|:------------|:------------|:-------------|:----------
| brand       |Promoting a brand, or a seasonal store |brand slug|`cold-storage`, `cold-storage-cny`
| brand_deals | Promotion Deals section of a brand|brand slug|`cold-storage`, `cold-storage-cny`
| url       | External links: blog, other sites| URL | `http://blog.honestbee.com`, `http://lazada.sg/honestbee`
| page         | Link with honestbee predefined internal pages|string from predefined page list|`referral`
| static         | It is a unclickable static image|blank|

Supported `page` type list:
- `referral`

+ Parameters
    + countryCode (required, string, `SG`) ... Country code

### Banners v2 [GET]

+ Request 200

    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "imageFileName": "sg_banner1.jpg",
                    "actionType": "brand",
                    "actionValue": "cold-storage"
                },
                {
                    "imageFileName": "sg_banner1.jpg",
                    "actionType": "brand",
                    "actionValue": "fair-price"
                }
            ]

## Banners with zone v2 [/api/zones/{zoneId}/banners?countryCode={countryCode}]
API for curated home banners filter by zone

+ Parameters
    + zoneId (required, number, `1`) ... Zone Id
    + countryCode (required, string, `SG`) ... Country code

### Banners v2 [GET]

+ Request 200
    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

    + Body

            [
                {
                    "imageFileName": "sg_banner1.jpg",
                    "actionType": "brand",
                    "actionValue": "cold-storage"
                },
                {
                    "imageFileName": "sg_banner1.jpg",
                    "actionType": "brand",
                    "actionValue": "fair-price"
                }
            ]

# Group Bee

## Rating [/api/bees/{beeId}/rating?access_token={accessToken}]
API for rating a bee

+ Parameters
    + beeId (required, integer, `1`) ... Bee id
    + accessToken (required, string, `66f8d4bf03914d40a82f766b215d941be3448cf67019647ff2e32b29fbc500e6`) ... Access token

### Rating v2 [POST]
+ Request 200 (application/json)

    + Attributes
          + rating: 1 (number) - Required. Rating for a bee, can only be a number from 1 to 5
          + order_fulfillment_id: 2 (number) - Required. Order fulfillment id
          + role: 0 (number) - Required. 0: Shopper, 1: Deliverer
          + comment: "This is a test comment" (string) - Optional. Optional comment

    + Body

            {
                "rating": 1,
                "comment": "This is a test comment",
                "order_fulfillment_id": 1,
                "role": 0
            }


    + Headers

            Accept: application/vnd.honestbee+json;version=2

+ Response 200 (application/json; charset=utf-8)

            {
                "ok": true
            }

<?php
$a = 1;
echo "Testing";
echo "Give it another go Another testing EDIT IN BRANCH MASTER";
echo "Feature1!";

echo "Well master has been editted";
echo "Feature2";
echo "FROM MASRTER";
echo "Changefrom2";
?>
