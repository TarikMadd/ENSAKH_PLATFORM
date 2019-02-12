function populate(id1,id2)
        {
            var s1=document.getElementById(id1);
            var s2=document.getElementById(id2);
            s2.innerHTML='';
            if(s1.value==1)
            {
                var optionarray=["|","A|A","B|B","C|C"];
            }
             if(s1.value==2)
            {
                var optionarray=["|","A|A","B|B","C|C"];
            }
             if(s1.value==3)
            {
                var optionarray=["|","A|A","B|B","C|C","D|D"];
            }
            /*if(s1.value=='PH')
            {
                var optionarray=["|","A|A","B|B","C|C","D|D"];
            }*/
            for(var option in optionarray){
              var pair = optionarray[option].split("|");
              var newOption = document.createElement("option");
              newOption.innerHTML = pair[0];
              newOption.value = pair[1];
              s2.options.add(newOption);
          }

      }
function populateBis(id1,id2,id3)
{
    var s1=document.getElementById(id1);
    var s2=document.getElementById(id2);
    var s3=document.getElementById(id3);
    s2.innerHTML='';
   if( s3.value==1)
   {
       switch (s1.value)
       {
           case 'A':
           {
               var optionarray=["|","1|1","2|2","3|3","4|4"];
               break;
           }
           case 'B':
           {
               var optionarray=["|","1|1","2|2","3|3","4|4"];
               break;
           }
           case 'C':
           {
               var optionarray=["|","1|1","2|2","3|3","4|4","5|5"];
               break;
           }
       }
   }
    if( s3.value==2)
    {
        switch (s1.value)
        {
            case 'A':
            {
                var optionarray=["|","1|1","2|2","3|3","4|4"];
                break;
            }
            case 'B':
            {
                var optionarray=["|","1|1","2|2","3|3","4|4"];
                break;
            }
            case 'C':
            {
                var optionarray=["|","1|1","2|2","3|3","4|4","5|5"];
                break;
            }
        }
    }
    if( s3.value==3)
    {
        switch (s1.value)
        {
            case 'A':
            {
                var optionarray=["|","1|1","2|2","3|3","4|4"];
            }
            case 'B':
            {
                var optionarray=["|","1|1","2|2","3|3","4|4"];
            }
            case 'C':
            {
                var optionarray=["|","1|1","2|2","3|3","4|4"];
            }
            case 'D':
            {
                var optionarray=["|","1|1","2|2","3|3","4|4"];
            }
        }
    }

    for(var option in optionarray){
        var pair = optionarray[option].split("|");
        var newOption = document.createElement("option");
        newOption.innerHTML = pair[0];
        newOption.value = pair[1];
        s2.options.add(newOption);
    }

}