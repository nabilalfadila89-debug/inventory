# Inventory System API v1

Base URL

http://localhost:8000/api/v1

---

## Register

POST /register

Body

```json
{
  "name": "Nabil",
  "email": "nabil@gmail.com",
  "password": "password",
  "password_confirmation": "password"
}
```

---

## Login

POST /login

```json
{
  "email": "nabil@gmail.com",
  "password": "password"
}
```

---

## Categories

GET /categories

POST /categories

GET /categories/{id}

PUT /categories/{id}

DELETE /categories/{id}

---

## Items

GET /items

POST /items

GET /items/{id}

PUT /items/{id}

DELETE /items/{id}  


## GET /api/v1/items

Description:
Mengambil data item.

### Filter Kategori

GET /api/v1/items?category_id={id}

Description:
Filter items by category.