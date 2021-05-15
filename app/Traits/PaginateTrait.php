<?php

namespace App\Traits;

trait PaginateTrait
{
    public function paginateTrait($href,$current_page,$total_page)
    {
        $paginate = "";
            if($current_page!=1)
            {
                $paginate .="<a class='paginate-item' href='".$href."?page=".($current_page-1)."'><i class='fa fa-chevron-left'></i></a>";
            }
        else{
               $paginate .="<button class='current-page'><</button>";
        }
         for($i = $current_page-3;$i < $current_page;$i++)
            {
                if($i>0)
                {
                $paginate .="<a class='paginate-item' href='".$href."?page=".$i."'>".$i."</a>";
                }
        }
           $paginate .="<button class='current-page'>".$i."</button>";
           for($i = $current_page+1; $i<=$current_page+3 && $i<=$total_page;$i++)
            {
                 $paginate .="<a class='paginate-item' href='".$href."?page=".$i."'>".$i."</a>";
            }
            if($current_page != $total_page)
            {
                   $paginate .="<a class='paginate-item' href='".$href."?page=".($current_page+1)."'><i class='fa fa-chevron-right'></i></a>";

            }
            else{
                  $paginate .="<button class='current-page'>></button>";
            }
            return $paginate;
    }
}
