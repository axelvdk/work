#!/bin/bash
if [[ "${#}" -ne "1" ]]
then
die "Usage: $0 <image>"
fi

IMAGE="${1}"

if [[ ! -f "${IMAGE}" ]]
then
die "File not found: ${IMAGE}"
fi

IMG_CHARS=`identify "$1" | cut -f 3 -d' '`
WIDTH=`echo $IMG_CHARS | cut -d'x' -f 1`
HEIGHT=`echo $IMG_CHARS | cut -d'x' -f 2`

echo -e "${WIDTH}x${HEIGHT}"
