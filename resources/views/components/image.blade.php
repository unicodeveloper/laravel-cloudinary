@php
 echo cloudinary()->getImageTag("{$publicId}")->scale(500,500)->crop()->serialize();
@endphp