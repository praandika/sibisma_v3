@if($o->warna == "Merah")

<td style="background-color: #C41212; color: #FFFFFF;">{{ $o->warna }}</td>

@elseif($o->warna == "Abu")

<td style="background-color: #BCB8B8;">{{ $o->warna }}</td>

@elseif($o->warna == "Hitam")

<td style="background-color: #353030; color: #FFFFFF;">{{ $o->warna }}</td>

@elseif($o->warna == "Biru")

<td style="background-color: #27359B; color: #FFFFFF;">{{ $o->warna }}</td>

@elseif($o->warna == "Kuning")

<td style="background-color: #FAF217;">{{ $o->warna }}</td>

@elseif($o->warna == "Silver")

<td style="background-color: #E4E2E2;">{{ $o->warna }}</td>

@elseif($o->warna == "Cokelat")

<td style="background-color: #5E3607; color: #FFFFFF;">{{ $o->warna }}</td>

@elseif($o->warna == "Hijau")

<td style="background-color: #31783E; color: #FFFFFF;">{{ $o->warna }}</td>

@elseif($o->warna == "GP Movistar")

<td style="background-color: #04096F; color: #FFFFFF;">{{ $o->warna }}</td>

@elseif($o->warna == "GP Monster")

<td style="background-color: #1B2257; color: #FFFFFF;">{{ $o->warna }}</td>

@elseif($o->warna == "Doxou")

<td style="background-color: #614B9F; color: #FFFFFF;">{{ $o->warna }}</td>

@elseif($o->warna == "Ungu")

<td style="background-color: #773283; color: #FFFFFF;">{{ $o->warna }}</td>

@elseif($o->warna == "Pink")

<td style="background-color: #F59FF4;">{{ $o->warna }}</td>

@elseif($o->warna == "Gold")

<td style="background-color: #CFB53B; color: #FFFFFF;">{{ $o->warna }}</td>

@elseif($o->warna == "Cyan")

<td style="background-color: #2CC6ED; color: #FFFFFF;">{{ $o->warna }}</td>

@elseif($o->warna == "Hitam Cyan")

<td style="background-color: #2CC6ED; color: #FFFFFF;">{{ $o->warna }}</td>

@elseif($o->warna == "Orange")

<td style="background-color: #CF8228; color: #FFFFFF;">{{ $o->warna }}</td>

@elseif($o->warna == "Putih")

<td style="background-color: #FFFFFF; color: #000000;">{{ $o->warna }}</td>

@else

<td>{{ $o->warna }}</td>

@endif