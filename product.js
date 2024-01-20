// -----------------product-----------------------------
const bigImg = document.querySelector(".product-content-left-big-img img")
const smallImg = document.querySelectorAll(".product-content-left-small-img img")
smallImg.forEach(function(imgItem,X){
    imgItem.addEventListener("click",function(){
        bigImg.src = imgItem.src
    })
})


const warranty = document.querySelector(".warranty")
const delivery = document.querySelector(".delivery")
const refund = document.querySelector(".refund")
if(warranty){
    warranty.addEventListener("click",function(){
        document.querySelector(".product-content-right-bottom-content-delivery").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-refund").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-warranty").style.display = "block"
    })
}
if(delivery){
    delivery.addEventListener("click",function(){
        document.querySelector(".product-content-right-bottom-content-delivery").style.display = "block"
        document.querySelector(".product-content-right-bottom-content-refund").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-warranty").style.display = "none"
    })
}
if(refund){
    refund.addEventListener("click",function(){
        document.querySelector(".product-content-right-bottom-content-delivery").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-refund").style.display = "block"
        document.querySelector(".product-content-right-bottom-content-warranty").style.display = "none"
    })
}
const bunTon = document.querySelector(".product-content-right-bottom-top")
if(bunTon){
    bunTon.addEventListener("click",function(){
    document.querySelector(".product-content-right-bottom-content-big").classList.toggle("activeA")
    })
}