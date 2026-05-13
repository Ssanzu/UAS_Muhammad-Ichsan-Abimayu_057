# TODO
- [ ] Update `process/set_pending.php`:
  - [ ] Start/ensure session
  - [ ] Set `$_SESSION['pending_booking_id'] = $bookingId`
  - [ ] Redirect to `../index.php?x=payment` on success
- [ ] Quick test: click payment button on `view/order.php` for a pending order and verify it opens `payment.php` and shows booking summary

