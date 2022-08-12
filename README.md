# inventory_manager

## Available API routes

- [List Items](#list-items)
- [New Item](#new-item)
- [Item Details](#item-details)
- [Update Item](#update-item)
- [Delete Item](#delete-item)
- [Increase Item Stock](#increase-item-stock)
- [Decrease Item Stock](#decrease-item-stock)
- [List Stores](#list-stores)
- [New Store](#new-store)
- [Store Details](#store-details)
- [Update Store](#update-store)
- [Delete Store](#delete-store)


## Returned Resources

### ItemResource
```
'id'
'storeId'
'fullName'
'itemCode'
'quantity'
'purchasePrice'
'markup'
'created'
```

### StoreResource
```
'id'
'name'
'costValue' => optionally requested
'potentialNet' => optionally requested
'potentialProfit' => optionally requested
'created'
'items' => optionally requested
```

## API route details
### List Items

Method: `GET|HEAD`

URL: `api/v1/items`

Query Params: `false`

Filtering: `true`
```
id['eq', 'lt', 'lte', 'gt', 'gte', 'neq'],
storeId['eq'],
fullName['eq'],
itemCode['eq'],
quantity['eq', 'lt', 'lte', 'gt', 'gte', 'neq'],
purchasePrice['eq', 'lt', 'lte', 'gt', 'gte', 'neq'],
markup['eq', 'lt', 'lte', 'gt', 'gte', 'neq'],
created['eq', 'lt', 'lte', 'gt', 'gte', 'neq']
```

Returns:
```
Collection of ItemResource
```

### New Item

Method: `POST`

URL: `api/v1/items`

Query Params: `false`

Filtering: `false`

Body: `true`
```
'store_id' => required
'full_name' => required
'item_code' => required, unique (per store)
'quantity' => required
'purchase_price' => required
'markup' => required
```

Returns:
```
ItemResource
```

### Item Details

Method: `GET|HEAD`

URL: `api/v1/items/{item}`

Query Params: `true`
```
required:
- {item} => item's id
```

Filtering: `false`

Returns:
```
ItemResource
```

### Update Item

Method: `PUT|PATCH`

URL: `api/v1/items/{item}`

Query Params: `true`
```
{item} => item's id
```

Filtering: `false`

Body: `true`
```
'store_id' => required (optional if PATCH)
'full_name' => required (optional if PATCH)
'item_code' => required (optional if PATCH), unique (per store)
'quantity' => required (optional if PATCH)
'purchase_price' => required (optional if PATCH)
'markup' => required (optional if PATCH)
```

Returns:
```
ItemResource
```

### Delete Item

Method: `DELETE`

URL: `api/v1/items/{item}`

Query Params: `true`
```
{item} => item's id
```

Filtering: `false`

Returns:
```
{
    "data": [
        "message":
    ]
}
```

### Increase Item Stock

Method: `POST`

URL: `api/v1/items/{item}/add`

Query Params: `true`
```
{item} => item's id
```

Filtering: `false`

Body: `true`
```
'amount' => required, min:1
```

Returns:
```
ItemResource
```

### Decrease Item Stock

Method: `POST`

URL: `api/v1/items/{item}/remove`

Query Params: `true`
```
{item} => item's id
```

Filtering: `false`

Body: `true`
```
'amount' => required, min: 1, max: item quantity
```

Returns:
```
ItemResource
```


### List Stores

Method: `GET|HEAD`

URL: `api/v1/stores`

Query Params: `true`
```
optional:
- includeItems => Includes all items owned by each store
- costValue => The value of a store's entire stock based on purchase price and quantity
- potentialNet => The value of a store's entire stock including markup
- potentialProfit => The difference between costValue and potentialNet
```

Filtering: `true`
```
id['eq', 'lt', 'lte', 'gt', 'gte', 'neq'],
name['eq'],
created['eq', 'lt', 'lte', 'gt', 'gte', 'neq']
```

Returns:
```
Collection of StoreResource
```

### New Store

Method: `POST`

URL: `api/v1/stores`

Query Params: `false`

Filtering: `false`

Body: `true`
```
'name' => required
```

Returns:
```
StoreResource
```

### Store Details

Method: `GET|HEAD`

URL: `api/v1/stores/{store}`

Query Params: `true`
```
required:
- {store} => store's id
optional:
- includeItems => Includes all items owned by each store
- costValue => The value of a store's entire stock based on purchase price and quantity
- potentialNet => The value of a store's entire stock including markup
- potentialProfit => The difference between costValue and potentialNet
```

Filtering: `false`

Returns:
```
StoreResource
```

### Update Store

Method: `PUT|PATCH`

URL: `api/v1/stores/{store}`

Query Params: `true`
```
required:
- {store} => store's id
```

Filtering: `false`

Body: `true`
```
'name' => required
```

Returns:
```
StoreResource
```

### Delete Store

Note: Deleting a store will also delete all items for that store

Method: `DELETE`

URL: `api/v1/stores/{store}`

Query Params: `true`
```
{store} => store's id
```

Filtering: `false`

Returns:
```
{
    "data": [
        "message":
    ]
}
```

## Filtering
> - Filtering is used to narrow down collections of returned resources
> - Each resource has specific field it allows filtering on
> - Each field has specific operators and requires one to be included
### Operator Keys
```
'eq' => '=',
'lt' => '<',
'lte' => '<=',
'gt' => '>',
'gte' => '>=',
'neq' => '!='
```
> Here is an example of how to all stores with an id between 1 and 5
```
https://.../api/v1/stores?id[gte]=1&id[lte]=5
```