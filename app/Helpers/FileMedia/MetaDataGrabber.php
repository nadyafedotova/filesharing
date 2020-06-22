<?php

namespace App\Helpers\FileMedia;

class MetaDataGrabber
{
    /**
     * Getting meta data from $fileInfo based on provided $fileType.
     *
     * @param string $fileType
     * @param array $fileInfo
     * @return array
     */
    public function grabMetaData(string $fileType, array $fileInfo): array
    {
        $metaData = [];

        switch ($fileType) {
            case "audio":
                $audioParameters = [
                    "bitrate" => $fileInfo["audio"]["bitrate"],
                    "sample_rate" => $fileInfo["audio"]["sample_rate"],
                    "channels_count" => $fileInfo["audio"]["channels"],
                ];

                $metaData["audio"] = $audioParameters;
                break;
            case "video":
                $audioParameters = [
                    "sample_rate" => $fileInfo["audio"]["sample_rate"],
                    "channels_count" => $fileInfo["audio"]["channels"],
                    "codec" => $fileInfo["audio"]["codec"]
                ];
                $videoParameters = [
                    "resolution_x" => $fileInfo["video"]["resolution_x"],
                    "resolution_y" => $fileInfo["video"]["resolution_y"]
                ];

                $metaData["audio"] = $audioParameters;
                $metaData["video"] = $videoParameters;
                break;
            case "image":
                $videoParameters = [
                    "resolution_x" => $fileInfo["video"]["resolution_x"],
                    "resolution_y" => $fileInfo["video"]["resolution_y"]
                ];
                if (array_key_exists("bits_per_sample", $fileInfo["video"])) {
                    $videoParameters["bits_per_sample"] = $fileInfo["video"]["bits_per_sample"];
                }

                $metaData["fileformat"] = $fileInfo["fileformat"];
                $metaData["video"] = $videoParameters;
                break;
        }
        return $metaData;
    }
}
