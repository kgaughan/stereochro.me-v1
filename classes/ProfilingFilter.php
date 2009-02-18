<?php
class TimingFilter implements AFK_Filter {

	public function execute(AFK_Pipeline $pipe, $ctx) {
		$start = microtime(true);
		$pipe->do_next($ctx);
		$time = microtime(true) - $start;
		if ($ctx->rendering_is_allowed()) {
			printf(
				"<!-- Processing time: %f seconds; final memory usage: %d; peak: %d -->",
				$time, memory_get_usage(), memory_get_peak_usage());
		}
	}
}
