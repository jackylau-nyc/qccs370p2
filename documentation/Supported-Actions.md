# Supported Actions

## Map
  
  **Request Type:** GET
  **Location:** /map
  **Required Parameters:**  {""}

## Accounts

### Admin Accounts

* Admin Sign In
  * **Request Type:** POST
  **Location:** /admin-signin
  **Required Parameters:**  {"username","password"}

### Customer Accounts

* Customer Sign Up
  * **Request Type:** POST
  * **Location:** /signup
  * **Required Parameters:**  {"username","password"}
* Customer Sign In
  * **Request Type:** POST
  **Location:** /signin
  **Required Parameters:**  {"username","password"}

### Logging Out (Customer & Admin)

* Logout
  * **Request Type:** POST
  * **Location:** /logout
  * **Required Parameters:**  {}

## Customer

* **Location:** /customer

* Get Active Customer Reservations
  * **Request Type:** GET
  * **Action:** "get-reservations"
  * **Required Parameters:**  {"username","date"}

* Cancel Customer Reservation
  * **Request Type:** GET
  * **Action:** "cancel-res"
  * **Required Parameters:**  {"res"}

## Reservations

* **Location:** /reservation

* Create Reservation
  * **Request Type:** POST
  * **Action:** "create-res"
  * **Required Parameters:**  {"username","x_cord", "y_cord", "room", "startDate", "endDate"}

* Cancel Reservation
  * **Request Type:** POST
  * **Action:** "cancel-res"
  * **Required Parameters:**  {"res"}

## Admin

* **Location:** /admin
  
* Add Room
  * **Request Type:** POST
  * **Action:** "add-room"
  * **Required Parameters:**  {"x_cord", "y_cord", "class", "price"}

* Add Rooms
  * **Request Type:** POST
  * **Action:** "add-rooms"
  * **Required Parameters:**  {"x_cord", "y_cord", "class", "price", "amount"}

* Add Hotel
  * **Request Type:** POST
  * **Action:** "get-all-res"
  * **Required Parameters:**  {"x_cord", "y_cord", "company_name"}

* Get Any-&-All Reservations
  * **Request Type:** GET
  * **Action:** "get-all-res"
  * **Required Parameters:**  {"company"}

* Get All Upcoming Reservations
  * **Request Type:** GET
  * **Action:** "get-upcoming-res"
  * **Required Parameters:**  {"company", "date"}  

* Get Active Reservations
  * **Request Type:** GET
  * **Action:** "get-active-res"
  * **Required Parameters:**  {"company", "date"}  

### Hotel

* **Location:** /hotel

* Get Hotel Home Page
  * **Request Type:** GET
  * **Action:** "hotel-page"
  * **Required Parameters:**  {"xcord", "ycord"}

* Get Hotel Reservation Page
  * **Request Type:** GET
  * **Action:** "res-page"
  * **Required Parameters:**  {"xcord", "ycord"}

* Get Rooms
  * **Request Type:** GET
  * **Action:** "rooms"
  * **Required Parameters:**  {"xcord", "ycord"}

* Get Available Room Class Counts
  * **Request Type:** GET
  * **Action:** "avail-room-class-counts"
  * **Required Parameters:**  {"xcord", "ycord", "date"}

* Get Available Room Records
  * **Request Type:** GET
  * **Action:** "avail-room-records"
  * **Required Parameters:**  {"xcord", "ycord", "date"}

* Get Classes
  * **Request Type:** GET
  * **Action:** "room-classes"
  * **Required Parameters:**  {"xcord", "ycord"}

* Get Room and Class Counts
  * **Request Type:** GET
  * **Action:** "room-class-counts"
  * **Required Parameters:**  {"xcord", "ycord"}

* Get Available Room and Class Counts
  * **Request Type:** GET
  * **Action:** "avail-room-class-counts"
  * **Required Parameters:**  {"xcord", "ycord"}

* Get Parent Company
  * **Request Type:** GET
  * **Action:** "company"
  * **Required Parameters:**  {"xcord", "ycord"}

### Search Engine

* **Location:** /search
  
* Find hotels having rooms costing more than $x.
  * **Request Type:** GET
  * **Action:** "find-rooms-gt"
  * **Required Parameters:**  {"price", "date"}

* Find hotels having rooms costing less than $x.
  * **Request Type:** GET
  * **Action:** "find-rooms-lt"
  * **Required Parameters:**  {"price", "date"}

* Find hotels having rooms costing less than or equal to $x.
  * **Request Type:** GET
  * **Action:** "find-rooms-le"
  * **Required Parameters:**  {"price", "date"}

* Find hotels having rooms costing greater than or equal to $x.
  * **Request Type:** GET
  * **Action:** "find-rooms-ge"
  * **Required Parameters:**  {"price", "date"}

* Find hotels having rooms costing exactly $x.
  * **Request Type:** GET
  * **Action:** "find-rooms-eq"
  * **Required Parameters:**  {"price", "date"}

* Find hotels having rooms costing between $x and $y.
  * **Request Type:** GET
  * **Action:** "find-rooms-bet"
  * **Required Parameters:**  {"minPrice", "maxPrice", "date"}

* Find hotels based on search terms targeting parent companies.
  * **Request Type:** GET
  * **Action:** "find-by-company"
  * **Required Parameters:**  {"term"}