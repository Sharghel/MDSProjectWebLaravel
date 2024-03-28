<div id="activity">
    @if (empty($items))
        <p>Aucun flux RSS trouvé pour cette catégorie.</p>
    @else
        @foreach ($items as $item)
            <div class="callout callout-{{$item->color}}">
                @php
                    $enclosure = $item->get_enclosure(0); // Récupère la première enclosure
                    $image_url = null;
                    if ($enclosure && $enclosure->get_type() === 'image/jpeg') { // Vérifie si l'enclosure est une image JPEG
                        $image_url = $enclosure->get_link();
                    }
                @endphp

                @if ($image_url)
                    <div style="display: flex;">
                        <div style="flex: 1; margin-right: 20px;">
                            <a style="color: blue; text-decoration: none;" href="{{$item->get_permalink()}}" target="_blank"><h5>{{$item->get_title()}}</h5></a>
                            <p>{{$item->get_date()}}</p>
                            <p>{{strip_tags($item->get_description())}}</p>
                        </div>
                        <div style="flex: 1;">
                            <img src="{{ $image_url }}" alt="Image" style="width: 100%;">
                        </div>
                    </div>
                @else
                    <a style="color: blue; text-decoration: none;" href="{{$item->get_permalink()}}" target="_blank"><h5>{{$item->get_title()}}</h5></a>
                    <p>{{$item->get_date()}}</p>
                    <p>{{strip_tags($item->get_description())}}</p>
                @endif
            </div>
        @endforeach
    @endif
</div>