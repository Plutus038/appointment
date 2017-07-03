<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## First run the composer update to get the dependencies

```
composer update
```

## Give 777 permission for storage folder and recursive folders in root path

```
sudo chmod 777 -R 'storage FolderPath'
```

## For database configuration, create a new database in your phpmyadmin with name called appointment, then change the password & user name in .env file (Then run this migration command)

```
php artisan migrate
```

## Run this command to initial data setup data in project folder (Refer this file database/seeds/DatabaseSeeder.php)
Command & uncommand the query to get the static record

```
php artisan db:seed
```

# Base Url :  [http://localhost/appointment/public/api]

**Add Doctor :**

>Method – POST

>Input Type – Raw Json

>URL - [/doctor] (http://localhost/appointment/public/api/doctor)

```
	Request input :
	{
		"name" : "Vimala",
		"email" : "Vimala.a@gmail.com",
		"department" : "Dentist",
		"gender" : "F",
		"available_start_time" : "2017-05-22 20:02:42",
		"available_end_time" : "2017-05-22 20:02:42"
	}
	Response output:
	{
		"id": 1,
		"uuid": "9b9bc657-de6d-4000-ab2b-bb879f744e98",
		"name": "Vimala",
		"email": "Vimala.a@gmail.com",
		"department": "Dentist",
		"gender": "F",
		"available_start_time": "2017-05-22 20:02:42",
		"available_end_time": "2017-05-22 20:02:42",
		"message": "Doctor information added successfully"
	}
```
**Get all the doctors list :**

>Method – GET

>URL - [/doctors] (http://localhost/appointment/public/api/doctors)

```
	Respone output :
	[
		{
			"uuid": "cadc5b19-7358-43d4-a83e-7356ce49d72e",
			"name": "Vimala"
		},
		{
			"uuid": "4b4a3d8b-3b66-4669-b1d0-b46312ecae1b",
			"name": "Vimala"
		},
		{
			"uuid": "9faa3011-4cba-4e07-976e-8b744371ad3d",
			"name": "Vimala"
		}
	]
```
**Create appointment for a doctor : (Get doctor uuid from previous service)**

>Method – POST

>Input Type – Raw Json

>URL - [/appointment] (http://localhost/appointment/public/api/appointment)
            ( Create a multiple request for a doctor with same time – if you accept one request, remaining will be cancelled, one hour will be blocked for this request )
```
	Request input :
	{
		"name" : "Guru",
		"doctor_uuid" : "9b9bc657-de6d-4000-ab2b-bb879f744e98",
		"reason" : "Head ache",
		"age" : "21",
		"gender" : "F",
		"appointment_time" : "2017-07-27 23:38:01",
		"status" : "REQUEST"
	}
	Response Output :
	{
		"id": 1,
		"uuid": "ffe877de-8530-4b57-96ec-8f94ff440e4c",
		"name": "Guru",
		"reason": "Head ache",
		"age": "21",
		"gender": "F",
		"appointment_time": "2017-07-27 23:38:01",
		"status": "REQUEST",
		"message": "Appointment created successfully"
	}
```
**Update a appointment status : (Get appointment uuid from, after successfull creation of appointment)**

>Method – PUT

>Input Type – Raw Json

>URL - (doctor/{doctor_uuid})
          [/doctor/f363c070-a752-4c0b-85ff-2c3e58f4e6e6] (http://localhost/appointment/public/api/doctor/f363c070-a752-4c0b-85ff-2c3e58f4e6e6)
```
	Request input :
	{
		"appointment_id" : "67ac42f6-e27c-4070-8759-a484df8f25d0",
		"status" : "ACCEPTED"
	}
	Request input :
	{
		"name" : "Guru",
		"doctor_uuid" : "4b4a3d8b-3b66-4669-b1d0-b46312ecae1b",
		"reason" : "Head ache",
		"age" : "21",
		"gender" : "F",
		"appointment_time" : "2017-06-27 23:38:01",
		"status" : "REQUEST"
	}
```

**For backend**

 - Doctors list (http://localhost/appointment/public/doctor)

 - Hit doctor name in the doctors list to get appointment list for the particular doctor

 - You have an option for timezone selection for a appointment list
