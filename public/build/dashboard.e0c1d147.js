(self.webpackChunk=self.webpackChunk||[]).push([[966],{2614:(e,t,r)=>{r(1058);var n=r(9755),o=r(7137);n(document).ready((function(){console.log(window.location.origin)})),o([document.querySelector("#todo"),document.querySelector("#in-progress"),document.querySelector("#review"),document.querySelector("#done")]).on("dragend",(function(e,t){console.log(e);var r=e.parentElement.getAttribute("id"),o=parseInt(e.getAttribute("data-id"));n.ajax({url:window.location.origin+"/task/update-status/"+o,type:"POST",data:{status:r},success:function(e){console.log(e)}})}))},3009:(e,t,r)=>{var n=r(7854),o=r(7293),a=r(1702),u=r(1340),c=r(3111).trim,i=r(1361),s=n.parseInt,l=n.Symbol,d=l&&l.iterator,p=/^[+-]?0x/i,f=a(p.exec),g=8!==s(i+"08")||22!==s(i+"0x16")||d&&!o((function(){s(Object(d))}));e.exports=g?function(e,t){var r=c(u(e));return s(r,t>>>0||(f(p,r)?16:10))}:s},3111:(e,t,r)=>{var n=r(1702),o=r(4488),a=r(1340),u=r(1361),c=n("".replace),i="["+u+"]",s=RegExp("^"+i+i+"*"),l=RegExp(i+i+"*$"),d=function(e){return function(t){var r=a(o(t));return 1&e&&(r=c(r,s,"")),2&e&&(r=c(r,l,"")),r}};e.exports={start:d(1),end:d(2),trim:d(3)}},1361:e=>{e.exports="\t\n\v\f\r                　\u2028\u2029\ufeff"},1058:(e,t,r)=>{var n=r(2109),o=r(3009);n({global:!0,forced:parseInt!=o},{parseInt:o})}},e=>{e.O(0,[755,342],(()=>{return t=2614,e(e.s=t);var t}));e.O()}]);