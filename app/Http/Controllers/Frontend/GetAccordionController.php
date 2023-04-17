<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accordion;
use App\Http\Resources\Accordion\AccordionIndexResource;

class GetAccordionController extends Controller
{
    public function index()
    {
        $accordions = Accordion::latest()->get();
        return AccordionIndexResource::collection($accordions);
    }
}
