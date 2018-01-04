package skiplist

import "math/rand"

const MAX_LEVEL 32

type SkipNode struct {
	key string
	val int
	forward[1] *SkipNode
}

type SkipList struct {
	length int
	header *SkipNode
	tail *SkipNode
	level int
}

func (*SkipNode) NewSkipNode() *SkipNode {
	return &SkipNode{"", 0, nil}
}

func (this *SkipNode) MakeSkipNode(key string, val int) *SkipNode {
	newNode := this.NewSkipNode()
	newNode.key = key
	newNode.val = val

	return newNode
}

func (skiplist *SkipList) NewSkipList() *SkipList {
	newskl = &SkipList{}

	newskl.length = 0
	newskl.header = skiplist.NewSkipNode()
	newskl.tail = nil
	newskl.level = 1
	i := 0
	for i < MAX_LEVEL {
		newskl.header.forward[i] = nil
		i++
	}

	return newskl
}

func (this *SkipList) CreateList() *SkipList {
	return NewSkipList()
}

func (skiplist *SkipList) Insert(key string, val int) {
	update := make([]SkipNode, MAX_LEVEL)
	tmp := skiplist.header
	i = skiplist.level
	for i >= 1 {
		for tmp.forward[i] != nil && tmp.forward[i].key < key {
			tmp = tmp.forward[i]
		}
		update[i] = tmp
		--i
	}
	tmp = tmp.forward[1]
	if tmp.key == key {
		tmp.val = val
	} else {
		newLvl = skiplist.RandomLevel()
		if newLvl > skiplist.level {
			i := skiplist.level + 1
			for i < newLvl {
				update[i] = skiplist.header
				i++
			}
			skiplist.level = newLvl
		}
		newNode = skiplist.MakeSkipNode(key, val)
		i := 1
		for i < newLvl {
			tmp.forward[i] = update[i].forward[i]
			update[i].forward[i] = tmp
		}
	}
}

func (this *SkipList) GetLength() int {
	return this.length
}

func (skiplist *SkipList) Search(key string) (int, int) {
	if skiplist.GetLength() == 0 {
		return 0, 0
	}
	x := skiplist.header
	for i := skiplist.level; i > 1; i-- {
		for x.forward[i].key < key {
			x = x.forward[i]
		}
	}

	x = x.forward[1]
	if x.key == key {
		return x.val, 1
	} else {
		return _, 0
	}
}

func (* SkipList) RandomLevel() int {
	level := 1
	for rand.Intn(65535) < 0.25 * 65535 {
		++level
	}

	return level < MAX_LEVEL ? level : MAX_LEVEL
}

func (skiplist *SkipList) Delete(key string) {
	update := make([]SkipNode, MAX_LEVEL)
	tmp = skiplist.header

	i := skiplist.level
	for i > 1 {
		if tmp.forward[i].key < key {
			tmp = tmp.forward[i]
		}
		--i
	}
	tmp = tmp.forward[1]
	if tmp.key == key {
		i := 1
		for i < skiplist.level {
			if update[i].forward[i] == tmp {
				break
			} else {
				update[i].forward[i] = tmp.forward[i]
			}
			++i
		}
	}
}
