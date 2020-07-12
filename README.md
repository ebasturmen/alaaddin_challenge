# Alaaddin Adworks Challenge
Simple, discount code publishing platform.
  - PHP CRUD REST API
  ### Features
  - User can sign-up, sign-in and take a coupon then send a email notification.
  - Admin can list all users and can delete user data.
  ### Tech
Included librarys:
* [Bootstrap]
* [jQuery]
* [Popper]
### API
Create user, parameters: name, surname, phone, email, password
```sh
/api/create.php
```
Read all users, parameters: none
```sh
/api/read.php
```
Read single user, parameters: id
```sh
/api/single_read.php
```
Update single user, parameters: id, name, surname, phone
```sh
/api/update.php
```
Delete user, parameters: id
```sh
/api/delete.php
```
Take coupon, parameters: user_id, coupon_id
```sh
/api/take_coupon.php
```
Get all unused coupons, parameters: none
```sh
/api/read_coupon.php
```

### Todos
 - Profile image upload
 - Admin can add new coupons
