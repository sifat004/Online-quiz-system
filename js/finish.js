   

   function finish(clicked_name)
        {
            var x;
            if(clicked_name=="done")
            {
                x = confirm("Are you sure to submit all your answers");
                if(x==true)
                {

                    return true;

                }
                else
                {
                    return false;
                }
            }
        }