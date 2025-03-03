<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class OptimizeImages
{
  public function handle(Request $request, Closure $next)
  {
    $response = $next($request);

    if ($request->hasFile('project_image') || $request->hasFile('project_gallery')) {
      $optimizerChain = OptimizerChainFactory::create();

      if ($request->hasFile('project_image')) {
        $optimizerChain->optimize($request->file('project_image')->path());
      }

      if ($request->hasFile('project_gallery')) {
        foreach ($request->file('project_gallery') as $image) {
          $optimizerChain->optimize($image->path());
        }
      }
    }

    return $response;
  }
}
