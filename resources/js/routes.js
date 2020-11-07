// auth component 
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;
let home = require('./components/home.vue').default;
// employee component 
let employee = require('./components/employee/index.vue').default;
let addemployee = require('./components/employee/create.vue').default;
let editmployee = require('./components/employee/edit.vue').default;
// employee component 
let addsupplier = require('./components/supplier/create.vue').default;
let allsupplier = require('./components/supplier/index.vue').default;
let editsupplier = require('./components/supplier/edit.vue').default;
// employee component 
let addcategory = require('./components/category/create.vue').default;
let allcategory = require('./components/category/index.vue').default;
let editcategory = require('./components/category/edit.vue').default;
// employee component 
let addproduct = require('./components/product/create.vue').default;
let allproduct = require('./components/product/index.vue').default;
let editproduct = require('./components/product/edit.vue').default;
// expense component 
let addexpense = require('./components/expense/create.vue').default;
let allexpense = require('./components/expense/index.vue').default;
let editexpense = require('./components/expense/edit.vue').default;
// salary 
let givensalary = require('./components/salary/all_employee.vue').default;
let paysalary = require('./components/salary/pay.vue').default;
let allsalary = require('./components/salary/index.vue').default;
let viewsalary = require('./components/salary/view-salary.vue').default;
let editsalary = require('./components/salary/edit-salary.vue').default;
// product stock 
let stockproduct = require('./components/stock/index.vue').default;
let editstock = require('./components/stock/edit.vue').default;
// customer 
let addcustomer = require('./components/customer/create.vue').default;
let allcustomer = require('./components/customer/index.vue').default;
let editcustomer = require('./components/customer/edit.vue').default;
// point of sale 
let pos = require('./components/pos/point-of-sale.vue').default;
// order 
let todayorder = require('./components/order/today-order.vue').default;
let vieworder = require('./components/order/view-order.vue').default;
let allorder = require('./components/order/all-order.vue').default;
let searchorder = require('./components/order/search-order.vue').default;

export const routes = [
    // auth routes 
    { path: '/', component: login, name:'/' },
    { path: '/register', component: register, name:'register' },
    { path: '/forget', component: forget, name:'forget' },
    { path: '/home', component: home, name:'home' },
    { path: '/logout', component: logout, name:'logout' },
    // employee routes------------------------------ 
    { path: '/add-employee', component: addemployee, name:'add-employee' },
    { path: '/employee', component: employee, name:'employee'},
    { path: '/edit-employee/:id', component: editmployee, name:'edit-employee' },
    // supplier routes 
    { path: '/add-supplier', component: addsupplier, name:'add-supplier'},
    { path: '/all-supplier', component: allsupplier, name:'all-supplier'},
    { path: '/edit-supplier/:id', component: editsupplier, name: 'edit-supplier'},
    // category routes 
    { path: '/add-category', component: addcategory, name:'add-category'},
    { path: '/all-category', component: allcategory, name:'all-category'},
    { path: '/edit-category/:id', component: editcategory, name:'edit-category'},
    // product routes 
    { path: '/add-product', component: addproduct, name:'add-product'},
    { path: '/all-product', component: allproduct, name:'all-product'},
    { path: '/edit-product/:id', component: editproduct, name:'edit-product'},
    // expense routes 
    { path: '/add-expense', component: addexpense, name:'add-expense'},
    { path: '/all-expense', component: allexpense, name:'all-expense'},
    { path: '/edit-expense/:id', component: editexpense, name:'edit-expense'},
    // salary 
    { path: '/given-salary', component: givensalary, name:'given-salary'},
    { path: '/pay-salary/:id', component: paysalary, name:'pay-salary'},
    { path: '/all-salary', component: allsalary, name:'all-salary'},
    { path: '/view-salary/:id', component: viewsalary, name:'view-salary'},
    { path: '/edit-salary/:id', component: editsalary, name:'edit-salary'},
    // prouduct stock 
    { path: '/product-stock', component: stockproduct, name:'product-stock'},
    { path: '/edit-stock/:id', component: editstock, name:'edit-stock'},
    // customer 
    { path: '/add-customer', component: addcustomer, name:'add-customer'},
    { path: '/all-customer', component: allcustomer, name:'all-customer'},
    { path: '/edit-customer/:id', component: editcustomer, name:'edit-customer'},
    // pos
    { path: '/pos', component: pos, name:'pos'},
    // order 
    { path: '/today-order', component: todayorder, name:'today-order'},
    { path: '/view-order/:id', component: vieworder, name:'view-order'},
    { path: '/all-order', component: allorder, name:'all-order'},
    { path: '/search-order', component: searchorder, name:'search-order'},



]