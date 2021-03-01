<html> 
    <head> 
        <title>conversion  des entiers decimal en base  b</title> 
    </head>
        <body>


            <h1>Bonjour à tout le monde.</h1>

            <img src="{{URL::to('images/' . $file)}}" alt="" srcset="">

            <script  language="javascript">   
                // var b,n,q,r,s; 
                // var result; 
                // b=prompt("entrez la base b"); // b=base
                // n=prompt("entrez un nombre entier"); // n=nombre entré
                // q=parseInt(n)/parseInt(b); // q=quotient de la division
                // r=parseInt(n)%parseInt(b); //r=reste de la division
                // result=Math.round(r); //resultat
                // while(q>0){
                //     q=parseInt(q)/parseInt(b);
                //     r=q%parseInt(b);
                //     console.log(q);
                //     result=result+''+Math.round(r);
                // }
                // alert(result); 

                function reverseString (_str) {
                	let splitStr = _str.split('');
                	let reverseStr = splitStr.reverse();
                	return reverseStr.join("");
                }
            </script> 
        </body> 
</html>