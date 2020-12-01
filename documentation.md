# 4 Add Edit Delete Products

1. Automatically Update SALES and ORDERS

# 5 Update List Price when UPrice in Newstocks changed

1. In order to accomplish the task #5 Sales and Orders Table are need to real-time
   because products table is automatically updated when new stocks Uprice is modified
   likewise the sales and orders list price should be updated

# 6 save customers order to orders table

1. create users and admins table, login, create account, forgot password(pet)
2. Add to cart, Edit quantity (real time get max products), Delete product
3. Qty = newstock qty + products,
<!--
    Qty = 12+ 3;
    userOrder =  13
    if userOrder >Qty
        error userOrder cannot exceed Qty

    if qty on products !=0 && qty on products >= userOrder
        products-= userOrder //products=0
        update products qty
    else if qty on new stocks !=0 && qty on newstocks >=userOrder
        newstock-=userOrder //newstocks=0
        update newstock qty
    else if userOrder !> Qty
     Qty-=userOrder // Qty=2
     products = Qty
    update products
    else
        error("Users order is larger than Available Qty of Products")


    SALES
    if qty on products and new stock =0
        print "Out of Stock";
  -->

# 7 admin page accounts

1. encoder (view/print) -jquery print is require #FIXME print functionality
2. senior staff -CRUD except for accounts
3. System admin -CRUD all

# 8 documentation & code

1. Word include pictures and screenshots
2. github link

# 9 all software development and resources

1. resources
2. tools include deployment??
