SELECT g.id, g.name
FROM goods as g
LEFT JOIN goods_tags as gt on gt.goods_id = g.id
GROUP BY g.id, g.name
HAVING COUNT(gt.tag_id) = (SELECT COUNT(id) FROM tags)