# Supported Actions

## Reservations

* Location: /reservation

### POST

* Create Reservation
  * **Action:** "create-res"
  * **Required Parameters:**  {"username","x_cord", "y_cord", "room", "startDate", "endDate"}

* Cancel Reservation
  * **Action:** "cancel-res"
  * **Required Parameters:**  {"res"}
